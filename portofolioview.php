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
$portofolio_view = new portofolio_view();

// Run the page
$portofolio_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portofolio_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$portofolio->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fportofolioview = currentForm = new ew.Form("fportofolioview", "view");

// Form_CustomValidate event
fportofolioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportofolioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$portofolio->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $portofolio_view->ExportOptions->render("body") ?>
<?php $portofolio_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $portofolio_view->showPageHeader(); ?>
<?php
$portofolio_view->showMessage();
?>
<?php if (!$portofolio_view->IsModal) { ?>
<?php if (!$portofolio->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portofolio_view->Pager)) $portofolio_view->Pager = new PrevNextPager($portofolio_view->StartRec, $portofolio_view->DisplayRecs, $portofolio_view->TotalRecs, $portofolio_view->AutoHidePager) ?>
<?php if ($portofolio_view->Pager->RecordCount > 0 && $portofolio_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fportofolioview" id="fportofolioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portofolio_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portofolio_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portofolio">
<input type="hidden" name="modal" value="<?php echo (int)$portofolio_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($portofolio->Judul->Visible) { // Judul ?>
	<tr id="r_Judul">
		<td class="<?php echo $portofolio_view->TableLeftColumnClass ?>"><span id="elh_portofolio_Judul"><?php echo $portofolio->Judul->caption() ?></span></td>
		<td data-name="Judul"<?php echo $portofolio->Judul->cellAttributes() ?>>
<span id="el_portofolio_Judul">
<span<?php echo $portofolio->Judul->viewAttributes() ?>>
<?php echo $portofolio->Judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($portofolio->Isi->Visible) { // Isi ?>
	<tr id="r_Isi">
		<td class="<?php echo $portofolio_view->TableLeftColumnClass ?>"><span id="elh_portofolio_Isi"><?php echo $portofolio->Isi->caption() ?></span></td>
		<td data-name="Isi"<?php echo $portofolio->Isi->cellAttributes() ?>>
<span id="el_portofolio_Isi">
<span<?php echo $portofolio->Isi->viewAttributes() ?>>
<?php echo $portofolio->Isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
	<tr id="r_Gambar">
		<td class="<?php echo $portofolio_view->TableLeftColumnClass ?>"><span id="elh_portofolio_Gambar"><?php echo $portofolio->Gambar->caption() ?></span></td>
		<td data-name="Gambar"<?php echo $portofolio->Gambar->cellAttributes() ?>>
<span id="el_portofolio_Gambar">
<span>
<?php echo GetFileViewTag($portofolio->Gambar, $portofolio->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$portofolio_view->IsModal) { ?>
<?php if (!$portofolio->isExport()) { ?>
<?php if (!isset($portofolio_view->Pager)) $portofolio_view->Pager = new PrevNextPager($portofolio_view->StartRec, $portofolio_view->DisplayRecs, $portofolio_view->TotalRecs, $portofolio_view->AutoHidePager) ?>
<?php if ($portofolio_view->Pager->RecordCount > 0 && $portofolio_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_view->pageUrl() ?>start=<?php echo $portofolio_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$portofolio_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$portofolio->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$portofolio_view->terminate();
?>