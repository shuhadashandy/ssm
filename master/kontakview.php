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
$kontak_view = new kontak_view();

// Run the page
$kontak_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kontak_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$kontak->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fkontakview = currentForm = new ew.Form("fkontakview", "view");

// Form_CustomValidate event
fkontakview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fkontakview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$kontak->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $kontak_view->ExportOptions->render("body") ?>
<?php $kontak_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kontak_view->showPageHeader(); ?>
<?php
$kontak_view->showMessage();
?>
<?php if (!$kontak_view->IsModal) { ?>
<?php if (!$kontak->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($kontak_view->Pager)) $kontak_view->Pager = new PrevNextPager($kontak_view->StartRec, $kontak_view->DisplayRecs, $kontak_view->TotalRecs, $kontak_view->AutoHidePager) ?>
<?php if ($kontak_view->Pager->RecordCount > 0 && $kontak_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fkontakview" id="fkontakview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($kontak_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $kontak_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kontak">
<input type="hidden" name="modal" value="<?php echo (int)$kontak_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($kontak->Nama->Visible) { // Nama ?>
	<tr id="r_Nama">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_Nama"><?php echo $kontak->Nama->caption() ?></span></td>
		<td data-name="Nama"<?php echo $kontak->Nama->cellAttributes() ?>>
<span id="el_kontak_Nama">
<span<?php echo $kontak->Nama->viewAttributes() ?>>
<?php echo $kontak->Nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak__Email"><?php echo $kontak->_Email->caption() ?></span></td>
		<td data-name="_Email"<?php echo $kontak->_Email->cellAttributes() ?>>
<span id="el_kontak__Email">
<span<?php echo $kontak->_Email->viewAttributes() ?>>
<?php echo $kontak->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak->Judul->Visible) { // Judul ?>
	<tr id="r_Judul">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_Judul"><?php echo $kontak->Judul->caption() ?></span></td>
		<td data-name="Judul"<?php echo $kontak->Judul->cellAttributes() ?>>
<span id="el_kontak_Judul">
<span<?php echo $kontak->Judul->viewAttributes() ?>>
<?php echo $kontak->Judul->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak->Isi->Visible) { // Isi ?>
	<tr id="r_Isi">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_Isi"><?php echo $kontak->Isi->caption() ?></span></td>
		<td data-name="Isi"<?php echo $kontak->Isi->cellAttributes() ?>>
<span id="el_kontak_Isi">
<span<?php echo $kontak->Isi->viewAttributes() ?>>
<?php echo $kontak->Isi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($kontak->Status->Visible) { // Status ?>
	<tr id="r_Status">
		<td class="<?php echo $kontak_view->TableLeftColumnClass ?>"><span id="elh_kontak_Status"><?php echo $kontak->Status->caption() ?></span></td>
		<td data-name="Status"<?php echo $kontak->Status->cellAttributes() ?>>
<span id="el_kontak_Status">
<span<?php echo $kontak->Status->viewAttributes() ?>>
<?php echo $kontak->Status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$kontak_view->IsModal) { ?>
<?php if (!$kontak->isExport()) { ?>
<?php if (!isset($kontak_view->Pager)) $kontak_view->Pager = new PrevNextPager($kontak_view->StartRec, $kontak_view->DisplayRecs, $kontak_view->TotalRecs, $kontak_view->AutoHidePager) ?>
<?php if ($kontak_view->Pager->RecordCount > 0 && $kontak_view->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($kontak_view->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($kontak_view->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $kontak_view->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($kontak_view->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($kontak_view->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $kontak_view->pageUrl() ?>start=<?php echo $kontak_view->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $kontak_view->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$kontak_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$kontak->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$kontak_view->terminate();
?>