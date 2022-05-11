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
$tentang_list = new tentang_list();

// Run the page
$tentang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tentang_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$tentang->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ftentanglist = currentForm = new ew.Form("ftentanglist", "list");
ftentanglist.formKeyCountName = '<?php echo $tentang_list->FormKeyCountName ?>';

// Form_CustomValidate event
ftentanglist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ftentanglist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ftentanglistsrch = currentSearchForm = new ew.Form("ftentanglistsrch");

// Filters
ftentanglistsrch.filterList = <?php echo $tentang_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$tentang->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tentang_list->TotalRecs > 0 && $tentang_list->ExportOptions->visible()) { ?>
<?php $tentang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tentang_list->ImportOptions->visible()) { ?>
<?php $tentang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tentang_list->SearchOptions->visible()) { ?>
<?php $tentang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tentang_list->FilterOptions->visible()) { ?>
<?php $tentang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tentang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tentang->isExport() && !$tentang->CurrentAction) { ?>
<form name="ftentanglistsrch" id="ftentanglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($tentang_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ftentanglistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tentang">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($tentang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($tentang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tentang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tentang_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tentang_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tentang_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tentang_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $tentang_list->showPageHeader(); ?>
<?php
$tentang_list->showMessage();
?>
<?php if ($tentang_list->TotalRecs > 0 || $tentang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tentang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tentang">
<?php if (!$tentang->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tentang->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tentang_list->Pager)) $tentang_list->Pager = new PrevNextPager($tentang_list->StartRec, $tentang_list->DisplayRecs, $tentang_list->TotalRecs, $tentang_list->AutoHidePager) ?>
<?php if ($tentang_list->Pager->RecordCount > 0 && $tentang_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tentang_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tentang_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tentang_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tentang_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tentang_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tentang_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tentang_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tentang_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tentang_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tentang_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tentang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftentanglist" id="ftentanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($tentang_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $tentang_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tentang">
<div id="gmp_tentang" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($tentang_list->TotalRecs > 0 || $tentang->isGridEdit()) { ?>
<table id="tbl_tentanglist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tentang_list->RowType = ROWTYPE_HEADER;

// Render list options
$tentang_list->renderListOptions();

// Render list options (header, left)
$tentang_list->ListOptions->render("header", "left");
?>
<?php if ($tentang->Judul->Visible) { // Judul ?>
	<?php if ($tentang->sortUrl($tentang->Judul) == "") { ?>
		<th data-name="Judul" class="<?php echo $tentang->Judul->headerCellClass() ?>"><div id="elh_tentang_Judul" class="tentang_Judul"><div class="ew-table-header-caption"><?php echo $tentang->Judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Judul" class="<?php echo $tentang->Judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tentang->SortUrl($tentang->Judul) ?>',1);"><div id="elh_tentang_Judul" class="tentang_Judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tentang->Judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tentang->Judul->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tentang->Judul->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tentang->Gambar->Visible) { // Gambar ?>
	<?php if ($tentang->sortUrl($tentang->Gambar) == "") { ?>
		<th data-name="Gambar" class="<?php echo $tentang->Gambar->headerCellClass() ?>"><div id="elh_tentang_Gambar" class="tentang_Gambar"><div class="ew-table-header-caption"><?php echo $tentang->Gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gambar" class="<?php echo $tentang->Gambar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $tentang->SortUrl($tentang->Gambar) ?>',1);"><div id="elh_tentang_Gambar" class="tentang_Gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tentang->Gambar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tentang->Gambar->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($tentang->Gambar->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tentang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tentang->ExportAll && $tentang->isExport()) {
	$tentang_list->StopRec = $tentang_list->TotalRecs;
} else {

	// Set the last record to display
	if ($tentang_list->TotalRecs > $tentang_list->StartRec + $tentang_list->DisplayRecs - 1)
		$tentang_list->StopRec = $tentang_list->StartRec + $tentang_list->DisplayRecs - 1;
	else
		$tentang_list->StopRec = $tentang_list->TotalRecs;
}
$tentang_list->RecCnt = $tentang_list->StartRec - 1;
if ($tentang_list->Recordset && !$tentang_list->Recordset->EOF) {
	$tentang_list->Recordset->moveFirst();
	$selectLimit = $tentang_list->UseSelectLimit;
	if (!$selectLimit && $tentang_list->StartRec > 1)
		$tentang_list->Recordset->move($tentang_list->StartRec - 1);
} elseif (!$tentang->AllowAddDeleteRow && $tentang_list->StopRec == 0) {
	$tentang_list->StopRec = $tentang->GridAddRowCount;
}

// Initialize aggregate
$tentang->RowType = ROWTYPE_AGGREGATEINIT;
$tentang->resetAttributes();
$tentang_list->renderRow();
while ($tentang_list->RecCnt < $tentang_list->StopRec) {
	$tentang_list->RecCnt++;
	if ($tentang_list->RecCnt >= $tentang_list->StartRec) {
		$tentang_list->RowCnt++;

		// Set up key count
		$tentang_list->KeyCount = $tentang_list->RowIndex;

		// Init row class and style
		$tentang->resetAttributes();
		$tentang->CssClass = "";
		if ($tentang->isGridAdd()) {
		} else {
			$tentang_list->loadRowValues($tentang_list->Recordset); // Load row values
		}
		$tentang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tentang->RowAttrs = array_merge($tentang->RowAttrs, array('data-rowindex'=>$tentang_list->RowCnt, 'id'=>'r' . $tentang_list->RowCnt . '_tentang', 'data-rowtype'=>$tentang->RowType));

		// Render row
		$tentang_list->renderRow();

		// Render list options
		$tentang_list->renderListOptions();
?>
	<tr<?php echo $tentang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tentang_list->ListOptions->render("body", "left", $tentang_list->RowCnt);
?>
	<?php if ($tentang->Judul->Visible) { // Judul ?>
		<td data-name="Judul"<?php echo $tentang->Judul->cellAttributes() ?>>
<span id="el<?php echo $tentang_list->RowCnt ?>_tentang_Judul" class="tentang_Judul">
<span<?php echo $tentang->Judul->viewAttributes() ?>>
<?php echo $tentang->Judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tentang->Gambar->Visible) { // Gambar ?>
		<td data-name="Gambar"<?php echo $tentang->Gambar->cellAttributes() ?>>
<span id="el<?php echo $tentang_list->RowCnt ?>_tentang_Gambar" class="tentang_Gambar">
<span>
<?php echo GetFileViewTag($tentang->Gambar, $tentang->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tentang_list->ListOptions->render("body", "right", $tentang_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$tentang->isGridAdd())
		$tentang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$tentang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tentang_list->Recordset)
	$tentang_list->Recordset->Close();
?>
<?php if (!$tentang->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tentang->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($tentang_list->Pager)) $tentang_list->Pager = new PrevNextPager($tentang_list->StartRec, $tentang_list->DisplayRecs, $tentang_list->TotalRecs, $tentang_list->AutoHidePager) ?>
<?php if ($tentang_list->Pager->RecordCount > 0 && $tentang_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($tentang_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($tentang_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $tentang_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($tentang_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($tentang_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $tentang_list->pageUrl() ?>start=<?php echo $tentang_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tentang_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($tentang_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tentang_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tentang_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tentang_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tentang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tentang_list->TotalRecs == 0 && !$tentang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tentang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tentang_list->showPageFooter();
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
$tentang_list->terminate();
?>