<?php

/**
 * Modal
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */

class RMHeader {
    private $title = '';
    
    public function __construct(string $title){
        $this->title = $title;
    }
    
    public function print(&$chartObj){
    ?>
       <link
        rel="stylesheet"
        href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">
  <?php $chartObj->initiateChartsLibrary(); ?>

    <header class="recensility-system-main-header">

	<div class="recensility-system-logo__container">
		<img class="recensility-system-logo" src="<?php echo plugins_url('/recensility-master/img/Recensility_n.png') ?>" alt="">
		<strong>Recensility System</strong>		
                <span class="recensility-system-subheader"><?php echo $this->title ?></span>
	</div>
	
    <div class="recensility-system-pages-menu">
        <ul class="recensility-system-ul">
            <li class="recensility-system-li active">
                <a class="recensility-system-pages-menu-a" href="#tabGeneric" data-menuslug="recensility_master_articles">
                    <span class="dashicons">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="title"> Home </span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="#tabArticle" data-menuslug="recensility_master_articles">
                    <span class="dashicons">
                        <i class="fas fa-file-alt"></i>
                    </span>
                    <span class="title"> Articoli</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="https://recensility.it/wp-admin/admin.php?page=WP-Optimize" data-menuslug="WP-Optimize">
                    <span class="dashicons">
                        <i class="fas fa-bullhorn"></i>
                    </span>
                    <span class="title"> Consigliati</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="javascript:callModal('mdDatasheet')" data-menuslug="recensility_master_datasheets">
                    <span class="dashicons">
                        <i class="fas fa-table"></i>
                    </span>
                    <span class="title"> Schede Tecniche</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="" data-menuslug="">
                    <span class="dashicons">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    <span class="title"> TechNews</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="https://recensility.it/wp-admin/admin.php?page=wpo_images" data-menuslug="wpo_images">
                    <span class="dashicons">
                        <i class="fas fa-swatchbook"></i>
                    </span>
                    <span class="title"> ColorFest</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="#tabFastLink" data-menuslug="recensility_master_fastlink">
                    <span class="dashicons">
                        <i class="fas fa-bolt"></i>
                    </span>
                    <span class="title"> Fast Link</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="https://recensility.it/wp-admin/admin.php?page=wpo_settings" data-menuslug="wpo_settings">
                    <span class="dashicons">
                        <i class="fas fa-trophy"></i>
                    </span>
                    <span class="title"> Top Ten</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="https://recensility.it/wp-admin/admin.php?page=wpo_settings" data-menuslug="wpo_settings">
                    <span class="dashicons">
                        <i class="fas fa-user"></i>
                    </span>
                    <span class="title"> User Report</span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="" data-menuslug="wpo_settings">
                    <span class="dashicons">
                        <i class="fas fa-magic"></i>
                    </span>
                    <span class="title"> Impostazioni </span>
                </a>
            </li>
            <li class="recensility-system-li">
                <a class="recensility-system-pages-menu-a" href="https://recensility.it/wp-admin/admin.php?page=wpo_support" data-menuslug="wpo_support">
                    <span class="dashicons dashicons-sos"></span>
                    <span class="title">Aiuto</span>
                </a>
            </li>
        </ul> 

        </div>	
        </header> 
    <?php
    }
}
