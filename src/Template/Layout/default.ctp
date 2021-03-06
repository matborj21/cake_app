<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('datatables.min.css') ?>
    <?= $this->Html->css('bootstrap-datetimepicker.css') ?>
    <?= $this->Html->css('fontawesome.min.css') ?>
    <?= $this->Html->css('custom.css') ?>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('bootstrapValidator.min.js') ?>
    <?= $this->Html->script('datatables.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('moment-with-locales.min.js') ?>
    <?= $this->Html->script('bootstrap-datetimepicker.min.js') ?>
    <?= $this->Html->script('script.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <?= $this->element('sidenav') ?>
    <?= $this->element('nav') ?>



    <div class="col-md-10 clearfix">

        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>

</body>

</html>