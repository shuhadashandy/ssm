<?php
namespace PHPMaker2019\SsmPT;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_tentang", $MenuLanguage->MenuPhrase("1", "MenuText"), "tentanglist.php", -1, "", IsLoggedIn() || AllowListMenu('{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}tentang'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_layanan", $MenuLanguage->MenuPhrase("2", "MenuText"), "layananlist.php", -1, "", IsLoggedIn() || AllowListMenu('{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}layanan'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_portofolio", $MenuLanguage->MenuPhrase("3", "MenuText"), "portofoliolist.php", -1, "", IsLoggedIn() || AllowListMenu('{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}portofolio'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_kontak", $MenuLanguage->MenuPhrase("4", "MenuText"), "kontaklist.php", -1, "", IsLoggedIn() || AllowListMenu('{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}kontak'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mci_FOOTER", $MenuLanguage->MenuPhrase("6", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_footerkiri", $MenuLanguage->MenuPhrase("5", "MenuText"), "footerkirilist.php", 6, "", IsLoggedIn() || AllowListMenu('{65C86988-D9B3-45F3-BFE9-EBEAEDC157CE}footerkiri'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>