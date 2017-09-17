<?php if($this->session->flashdata('msg')){ ?>
<div class="callout callout-success lead">  <p> <?php echo $this->session->flashdata('msg'); ?></p> </div>
<? }
?>
<?php if($this->session->flashdata('error')){ ?>
<div class="callout callout-danger lead">  <p> <?php echo $this->session->flashdata('error'); ?></p> </div>
<?
}
?>
<?php if(isset($error) && $error!=""){ ?>
<div class="callout callout-danger lead">  <p> <?php echo $error; ?></p> </div>
<? }?>
