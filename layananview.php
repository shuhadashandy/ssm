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
$layanan_view = new layanan_view();

// Run the page
$layanan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$layanan_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$layanan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var flayananview = currentForm = new ew.Form("flayananview", "view");

// Form_CustomValidate event
flayananview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flayananview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$layanan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $layanan_view->ExportOptions->render("body") ?>
<?php $layanan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $layanan_view->showPageHeader(); ?>
<?php
$layanan_view->showMessage();
?>
<?php if (!$layanan_view->IsModal) { ?>
<?php if (!$layanan->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($layanan_view->Pager)) $layanan_view->Pager = new PrevNextPager($layanan_view->StartRec, $layanan_view->DisplayRecs, $layanan_view->TotalRecs, $layanan_view->AutoHidePager) ?>
<?php if ($layanan_view->Pager->RecordCount > 0 && $layanan_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="flayananview" id="flayananview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($layanan_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $layanan_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="layanan">
<input type="hidden" name="modal" value="<?php echo (int)$layanan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($layanan->Judul->Visible) { // Judul ?>
	<tr id="r_Judul">
		<td class="<?php echo $layanan_view->TableLeftColumnClass ?>"><span id="elh_layanan_Judul"><?php echo $layanan->Judul->caption() ?></span></td>
		<td data-name="Judul"<?php echo $layanan->Judul->cellAttributes() ?>>
<span id="el_layanan_Judul">
<span<?php echo $layanan->Judul->viewAttributes() ?>>
<?php echo $layanan->Judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
	<tr id="r_Gambar">
		<td class="<?php echo $layanan_view->TableLeftColumnClass ?>"><span id="elh_layanan_Gambar"><?php echo $layanan->Gambar->caption() ?></span></td>
		<td data-name="Gambar"<?php echo $layanan->Gambar->cellAttributes() ?>>
<span id="el_layanan_Gambar">
<span>
<?php echo GetFileViewTag($layanan->Gambar, $layanan->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($layanan->Isi->Visible) { // Isi ?>
	<tr id="r_Isi">
		<td class="<?php echo $layanan_view->TableLeftColumnClass ?>"><span id="elh_layanan_Isi"><?php echo $layanan->Isi->caption() ?></span></td>
		<td data-name="Isi"<?php echo $layanan->Isi->cellAttributes() ?>>
<span id="el_layanan_Isi">
<span<?php echo $layanan->Isi->viewAttributes() ?>>
<?php echo $layanan->Isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$layanan_view->IsModal) { ?>
<?php if (!$layanan->isExport()) { ?>
<?php if (!isset($layanan_view->Pager)) $layanan_view->Pager = new PrevNextPager($layanan_view->StartRec, $layanan_view->DisplayRecs, $layanan_view->TotalRecs, $layanan_view->AutoHidePager) ?>
<?php if ($layanan_view->Pager->RecordCount > 0 && $layanan_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_view->pageUrl() ?>start=<?php echo $layanan_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$layanan_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$layanan->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$layanan_view->terminate();
?>