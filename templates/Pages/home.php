<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

if (!Configure::read('debug')) :
    throw new NotFoundException(
            'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
    <head>
<?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
        </title>
<?= $this->Html->meta('icon') ?>

        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

        <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
<?= $this->fetch('script') ?>
    </head>
    <body>
        <main class="main">
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="column">
                            <div class="message default text-center">
                                <small> <div class="container text-center">
                                <h1>Shipping price calculation</h2>
                                    <a href="/zones" class="button">Zones</a><br />
                                    <a href="/shippings"class="button" >Shipping price</a>
                                </div></small>
                            </div>

                            <?php Debugger::checkSecurityKeys(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <h4>Environment</h4>
                            <ul>
                                <?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) : ?>
                                    <li class="bullet success">Your version of PHP is 7.2.0 or higher (detected <?php echo PHP_VERSION ?>).</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your version of PHP is too low. You need PHP 7.2.0 or higher to use CakePHP (detected <?php echo PHP_VERSION ?>).</li>
                                <?php endif; ?>

                                <?php if (extension_loaded('mbstring')) : ?>
                                    <li class="bullet success">Your version of PHP has the mbstring extension loaded.</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your version of PHP does NOT have the mbstring extension loaded.</li>
                                <?php endif; ?>

                                <?php if (extension_loaded('openssl')) : ?>
                                    <li class="bullet success">Your version of PHP has the openssl extension loaded.</li>
                                <?php elseif (extension_loaded('mcrypt')) : ?>
                                    <li class="bullet success">Your version of PHP has the mcrypt extension loaded.</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your version of PHP does NOT have the openssl or mcrypt extension loaded.</li>
                                <?php endif; ?>

                                <?php if (extension_loaded('intl')) : ?>
                                    <li class="bullet success">Your version of PHP has the intl extension loaded.</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your version of PHP does NOT have the intl extension loaded.</li>
                            <?php endif; ?>
                            </ul>
                        </div>
                        <div class="column">
                            <h4>Filesystem</h4>
                            <ul>
                                <?php if (is_writable(TMP)) : ?>
                                    <li class="bullet success">Your tmp directory is writable.</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your tmp directory is NOT writable.</li>
                                <?php endif; ?>

                                <?php if (is_writable(LOGS)) : ?>
                                    <li class="bullet success">Your logs directory is writable.</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your logs directory is NOT writable.</li>
                                <?php endif; ?>

                                <?php $settings = Cache::getConfig('_cake_core_'); ?>
                                <?php if (!empty($settings)) : ?>
                                    <li class="bullet success">The <em><?php echo $settings['className'] ?>Engine</em> is being used for core caching. To change the config edit config/app.php</li>
                                <?php else : ?>
                                    <li class="bullet problem">Your cache is NOT working. Please check the settings in config/app.php</li>
<?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="column">
                            <h4>Database</h4>
                            <?php
                            try {
                                $connection = ConnectionManager::get('default');
                                $connected = $connection->connect();
                            } catch (Exception $connectionError) {
                                $connected = false;
                                $errorMsg = $connectionError->getMessage();
                                if (method_exists($connectionError, 'getAttributes')) :
                                    $attributes = $connectionError->getAttributes();
                                    if (isset($errorMsg['message'])) :
                                        $errorMsg .= '<br />' . $attributes['message'];
                                    endif;
                                endif;
                            }
                            ?>
                            <ul>
                                <?php if ($connected) : ?>
                                    <li class="bullet success">CakePHP is able to connect to the database.</li>
                                <?php else : ?>
                                    <li class="bullet problem">CakePHP is NOT able to connect to the database.<br /><?php echo $errorMsg ?></li>
<?php endif; ?>
                            </ul>
                        </div>
                        <div class="column">
                            <h4>DebugKit</h4>
                            <ul>
                                <?php if (Plugin::isLoaded('DebugKit')) : ?>
                                    <li class="bullet success">DebugKit is loaded.</li>
                                <?php else : ?>
                                    <li class="bullet problem">DebugKit is NOT loaded. You need to either install pdo_sqlite, or define the "debug_kit" connection name.</li>
<?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </main>
    </body>
</html>
