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
$layanan_list = new layanan_list();

// Run the page
$layanan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$layanan_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$layanan->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var flayananlist = currentForm = new ew.Form("flayananlist", "list");
flayananlist.formKeyCountName = '<?php echo $layanan_list->FormKeyCountName ?>';

// Form_CustomValidate event
flayananlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
flayananlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var flayananlistsrch = currentSearchForm = new ew.Form("flayananlistsrch");

// Filters
flayananlistsrch.filterList = <?php echo $layanan_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$layanan->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($layanan_list->TotalRecs > 0 && $layanan_list->ExportOptions->visible()) { ?>
<?php $layanan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($layanan_list->ImportOptions->visible()) { ?>
<?php $layanan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($layanan_list->SearchOptions->visible()) { ?>
<?php $layanan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($layanan_list->FilterOptions->visible()) { ?>
<?php $layanan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$layanan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$layanan->isExport() && !$layanan->CurrentAction) { ?>
<form name="flayananlistsrch" id="flayananlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($layanan_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="flayananlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="layanan">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($layanan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($layanan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $layanan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($layanan_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($layanan_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($layanan_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($layanan_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $layanan_list->showPageHeader(); ?>
<?php
$layanan_list->showMessage();
?>
<?php if ($layanan_list->TotalRecs > 0 || $layanan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($layanan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> layanan">
<?php if (!$layanan->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$layanan->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($layanan_list->Pager)) $layanan_list->Pager = new PrevNextPager($layanan_list->StartRec, $layanan_list->DisplayRecs, $layanan_list->TotalRecs, $layanan_list->AutoHidePager) ?>
<?php if ($layanan_list->Pager->RecordCount > 0 && $layanan_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($layanan_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $layanan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $layanan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $layanan_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $layanan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flayananlist" id="flayananlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($layanan_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $layanan_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="layanan">
<div id="gmp_layanan" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($layanan_list->TotalRecs > 0 || $layanan->isGridEdit()) { ?>
<table id="tbl_layananlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$layanan_list->RowType = ROWTYPE_HEADER;

// Render list options
$layanan_list->renderListOptions();

// Render list options (header, left)
$layanan_list->ListOptions->render("header", "left");
?>
<?php if ($layanan->Judul->Visible) { // Judul ?>
	<?php if ($layanan->sortUrl($layanan->Judul) == "") { ?>
		<th data-name="Judul" class="<?php echo $layanan->Judul->headerCellClass() ?>"><div id="elh_layanan_Judul" class="layanan_Judul"><div class="ew-table-header-caption"><?php echo $layanan->Judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Judul" class="<?php echo $layanan->Judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $layanan->SortUrl($layanan->Judul) ?>',1);"><div id="elh_layanan_Judul" class="layanan_Judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $layanan->Judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($layanan->Judul->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($layanan->Judul->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($layanan->Gambar->Visible) { // Gambar ?>
	<?php if ($layanan->sortUrl($layanan->Gambar) == "") { ?>
		<th data-name="Gambar" class="<?php echo $layanan->Gambar->headerCellClass() ?>"><div id="elh_layanan_Gambar" class="layanan_Gambar"><div class="ew-table-header-caption"><?php echo $layanan->Gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gambar" class="<?php echo $layanan->Gambar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $layanan->SortUrl($layanan->Gambar) ?>',1);"><div id="elh_layanan_Gambar" class="layanan_Gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $layanan->Gambar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($layanan->Gambar->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($layanan->Gambar->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$layanan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($layanan->ExportAll && $layanan->isExport()) {
	$layanan_list->StopRec = $layanan_list->TotalRecs;
} else {

	// Set the last record to display
	if ($layanan_list->TotalRecs > $layanan_list->StartRec + $layanan_list->DisplayRecs - 1)
		$layanan_list->StopRec = $layanan_list->StartRec + $layanan_list->DisplayRecs - 1;
	else
		$layanan_list->StopRec = $layanan_list->TotalRecs;
}
$layanan_list->RecCnt = $layanan_list->StartRec - 1;
if ($layanan_list->Recordset && !$layanan_list->Recordset->EOF) {
	$layanan_list->Recordset->moveFirst();
	$selectLimit = $layanan_list->UseSelectLimit;
	if (!$selectLimit && $layanan_list->StartRec > 1)
		$layanan_list->Recordset->move($layanan_list->StartRec - 1);
} elseif (!$layanan->AllowAddDeleteRow && $layanan_list->StopRec == 0) {
	$layanan_list->StopRec = $layanan->GridAddRowCount;
}

// Initialize aggregate
$layanan->RowType = ROWTYPE_AGGREGATEINIT;
$layanan->resetAttributes();
$layanan_list->renderRow();
while ($layanan_list->RecCnt < $layanan_list->StopRec) {
	$layanan_list->RecCnt++;
	if ($layanan_list->RecCnt >= $layanan_list->StartRec) {
		$layanan_list->RowCnt++;

		// Set up key count
		$layanan_list->KeyCount = $layanan_list->RowIndex;

		// Init row class and style
		$layanan->resetAttributes();
		$layanan->CssClass = "";
		if ($layanan->isGridAdd()) {
		} else {
			$layanan_list->loadRowValues($layanan_list->Recordset); // Load row values
		}
		$layanan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$layanan->RowAttrs = array_merge($layanan->RowAttrs, array('data-rowindex'=>$layanan_list->RowCnt, 'id'=>'r' . $layanan_list->RowCnt . '_layanan', 'data-rowtype'=>$layanan->RowType));

		// Render row
		$layanan_list->renderRow();

		// Render list options
		$layanan_list->renderListOptions();
?>
	<tr<?php echo $layanan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$layanan_list->ListOptions->render("body", "left", $layanan_list->RowCnt);
?>
	<?php if ($layanan->Judul->Visible) { // Judul ?>
		<td data-name="Judul"<?php echo $layanan->Judul->cellAttributes() ?>>
<span id="el<?php echo $layanan_list->RowCnt ?>_layanan_Judul" class="layanan_Judul">
<span<?php echo $layanan->Judul->viewAttributes() ?>>
<?php echo $layanan->Judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($layanan->Gambar->Visible) { // Gambar ?>
		<td data-name="Gambar"<?php echo $layanan->Gambar->cellAttributes() ?>>
<span id="el<?php echo $layanan_list->RowCnt ?>_layanan_Gambar" class="layanan_Gambar">
<span>
<?php echo GetFileViewTag($layanan->Gambar, $layanan->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$layanan_list->ListOptions->render("body", "right", $layanan_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$layanan->isGridAdd())
		$layanan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$layanan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($layanan_list->Recordset)
	$layanan_list->Recordset->Close();
?>
<?php if (!$layanan->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$layanan->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($layanan_list->Pager)) $layanan_list->Pager = new PrevNextPager($layanan_list->StartRec, $layanan_list->DisplayRecs, $layanan_list->TotalRecs, $layanan_list->AutoHidePager) ?>
<?php if ($layanan_list->Pager->RecordCount > 0 && $layanan_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($layanan_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($layanan_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $layanan_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($layanan_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($layanan_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $layanan_list->pageUrl() ?>start=<?php echo $layanan_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $layanan_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($layanan_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $layanan_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $layanan_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $layanan_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $layanan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($layanan_list->TotalRecs == 0 && !$layanan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $layanan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$layanan_list->showPageFooter();
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
$layanan_list->terminate();
?>