<?php
namespace PHPMaker2019\SsmPT;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$tentang_view = new tentang_view();

// Run the page
$tentang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tentang_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tentang->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ftentangview = currentForm = new ew.Form("ftentangview", "view");

// Form_CustomValidate event
ftentangview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftentangview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tentang->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $tentang_view->ExportOptions->render("body") ?>
<?php $tentang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $tentang_view->showPageHeader(); ?>
<?php
$tentang_view->showMessage();
?>
<?php if (!$tentang_view->IsModal) { ?>
<?php if (!$tentang->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tentang_view->Pager)) $tentang_view->Pager = new PrevNextPager($tentang_view->StartRec, $tentang_view->DisplayRecs, $tentang_view->TotalRecs, $tentang_view->AutoHidePager) ?>
<?php if ($tentang_view->Pager->RecordCount > 0 && $tentang_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tentang_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tentang_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tentang_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tentang_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tentang_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tentang_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftentangview" id="ftentangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tentang_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tentang_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tentang">
<input type="hidden" name="modal" value="<?php echo (int)$tentang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($tentang->Judul->Visible) { // Judul ?>
	<tr id="r_Judul">
		<td class="<?php echo $tentang_view->TableLeftColumnClass ?>"><span id="elh_tentang_Judul"><?php echo $tentang->Judul->caption() ?></span></td>
		<td data-name="Judul"<?php echo $tentang->Judul->cellAttributes() ?>>
<span id="el_tentang_Judul">
<span<?php echo $tentang->Judul->viewAttributes() ?>>
<?php echo $tentang->Judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tentang->Gambar->Visible) { // Gambar ?>
	<tr id="r_Gambar">
		<td class="<?php echo $tentang_view->TableLeftColumnClass ?>"><span id="elh_tentang_Gambar"><?php echo $tentang->Gambar->caption() ?></span></td>
		<td data-name="Gambar"<?php echo $tentang->Gambar->cellAttributes() ?>>
<span id="el_tentang_Gambar">
<span>
<?php echo GetFileViewTag($tentang->Gambar, $tentang->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($tentang->Isi->Visible) { // Isi ?>
	<tr id="r_Isi">
		<td class="<?php echo $tentang_view->TableLeftColumnClass ?>"><span id="elh_tentang_Isi"><?php echo $tentang->Isi->caption() ?></span></td>
		<td data-name="Isi"<?php echo $tentang->Isi->cellAttributes() ?>>
<span id="el_tentang_Isi">
<span<?php echo $tentang->Isi->viewAttributes() ?>>
<?php echo $tentang->Isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$tentang_view->IsModal) { ?>
<?php if (!$tentang->isExport()) { ?>
<?php if (!isset($tentang_view->Pager)) $tentang_view->Pager = new PrevNextPager($tentang_view->StartRec, $tentang_view->DisplayRecs, $tentang_view->TotalRecs, $tentang_view->AutoHidePager) ?>
<?php if ($tentang_view->Pager->RecordCount > 0 && $tentang_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tentang_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tentang_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tentang_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tentang_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tentang_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tentang_view->pageUrl() ?>start=<?php echo $tentang_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tentang_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$tentang_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$tentang->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$tentang_view->terminate();
?>