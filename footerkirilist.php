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
$footerkiri_list = new footerkiri_list();

// Run the page
$footerkiri_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$footerkiri_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$footerkiri->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffooterkirilist = currentForm = new ew.Form("ffooterkirilist", "list");
ffooterkirilist.formKeyCountName = '<?php echo $footerkiri_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffooterkirilist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffooterkirilist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffooterkirilistsrch = currentSearchForm = new ew.Form("ffooterkirilistsrch");

// Filters
ffooterkirilistsrch.filterList = <?php echo $footerkiri_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$footerkiri->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($footerkiri_list->TotalRecs > 0 && $footerkiri_list->ExportOptions->visible()) { ?>
<?php $footerkiri_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($footerkiri_list->ImportOptions->visible()) { ?>
<?php $footerkiri_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($footerkiri_list->SearchOptions->visible()) { ?>
<?php $footerkiri_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($footerkiri_list->FilterOptions->visible()) { ?>
<?php $footerkiri_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$footerkiri_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$footerkiri->isExport() && !$footerkiri->CurrentAction) { ?>
<form name="ffooterkirilistsrch" id="ffooterkirilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($footerkiri_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffooterkirilistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="footerkiri">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($footerkiri_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($footerkiri_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $footerkiri_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($footerkiri_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($footerkiri_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($footerkiri_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($footerkiri_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $footerkiri_list->showPageHeader(); ?>
<?php
$footerkiri_list->showMessage();
?>
<?php if ($footerkiri_list->TotalRecs > 0 || $footerkiri->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($footerkiri_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> footerkiri">
<?php if (!$footerkiri->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$footerkiri->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($footerkiri_list->Pager)) $footerkiri_list->Pager = new PrevNextPager($footerkiri_list->StartRec, $footerkiri_list->DisplayRecs, $footerkiri_list->TotalRecs, $footerkiri_list->AutoHidePager) ?>
<?php if ($footerkiri_list->Pager->RecordCount > 0 && $footerkiri_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($footerkiri_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($footerkiri_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $footerkiri_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($footerkiri_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($footerkiri_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $footerkiri_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($footerkiri_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $footerkiri_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $footerkiri_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $footerkiri_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $footerkiri_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffooterkirilist" id="ffooterkirilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($footerkiri_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $footerkiri_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="footerkiri">
<div id="gmp_footerkiri" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($footerkiri_list->TotalRecs > 0 || $footerkiri->isGridEdit()) { ?>
<table id="tbl_footerkirilist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$footerkiri_list->RowType = ROWTYPE_HEADER;

// Render list options
$footerkiri_list->renderListOptions();

// Render list options (header, left)
$footerkiri_list->ListOptions->render("header", "left");
?>
<?php if ($footerkiri->Judul->Visible) { // Judul ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Judul) == "") { ?>
		<th data-name="Judul" class="<?php echo $footerkiri->Judul->headerCellClass() ?>"><div id="elh_footerkiri_Judul" class="footerkiri_Judul"><div class="ew-table-header-caption"><?php echo $footerkiri->Judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Judul" class="<?php echo $footerkiri->Judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Judul) ?>',1);"><div id="elh_footerkiri_Judul" class="footerkiri_Judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Judul->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Judul->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Isi->Visible) { // Isi ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Isi) == "") { ?>
		<th data-name="Isi" class="<?php echo $footerkiri->Isi->headerCellClass() ?>"><div id="elh_footerkiri_Isi" class="footerkiri_Isi"><div class="ew-table-header-caption"><?php echo $footerkiri->Isi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Isi" class="<?php echo $footerkiri->Isi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Isi) ?>',1);"><div id="elh_footerkiri_Isi" class="footerkiri_Isi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Isi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Isi->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Isi->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Isi2) == "") { ?>
		<th data-name="Isi2" class="<?php echo $footerkiri->Isi2->headerCellClass() ?>"><div id="elh_footerkiri_Isi2" class="footerkiri_Isi2"><div class="ew-table-header-caption"><?php echo $footerkiri->Isi2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Isi2" class="<?php echo $footerkiri->Isi2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Isi2) ?>',1);"><div id="elh_footerkiri_Isi2" class="footerkiri_Isi2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Isi2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Isi2->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Isi2->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Phone->Visible) { // Phone ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Phone) == "") { ?>
		<th data-name="Phone" class="<?php echo $footerkiri->Phone->headerCellClass() ?>"><div id="elh_footerkiri_Phone" class="footerkiri_Phone"><div class="ew-table-header-caption"><?php echo $footerkiri->Phone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Phone" class="<?php echo $footerkiri->Phone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Phone) ?>',1);"><div id="elh_footerkiri_Phone" class="footerkiri_Phone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Phone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Phone->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Phone->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->_Email->Visible) { // Email ?>
	<?php if ($footerkiri->sortUrl($footerkiri->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $footerkiri->_Email->headerCellClass() ?>"><div id="elh_footerkiri__Email" class="footerkiri__Email"><div class="ew-table-header-caption"><?php echo $footerkiri->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $footerkiri->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->_Email) ?>',1);"><div id="elh_footerkiri__Email" class="footerkiri__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->_Email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->_Email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Twitter) == "") { ?>
		<th data-name="Twitter" class="<?php echo $footerkiri->Twitter->headerCellClass() ?>"><div id="elh_footerkiri_Twitter" class="footerkiri_Twitter"><div class="ew-table-header-caption"><?php echo $footerkiri->Twitter->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Twitter" class="<?php echo $footerkiri->Twitter->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Twitter) ?>',1);"><div id="elh_footerkiri_Twitter" class="footerkiri_Twitter">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Twitter->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Twitter->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Twitter->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Facebook) == "") { ?>
		<th data-name="Facebook" class="<?php echo $footerkiri->Facebook->headerCellClass() ?>"><div id="elh_footerkiri_Facebook" class="footerkiri_Facebook"><div class="ew-table-header-caption"><?php echo $footerkiri->Facebook->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Facebook" class="<?php echo $footerkiri->Facebook->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Facebook) ?>',1);"><div id="elh_footerkiri_Facebook" class="footerkiri_Facebook">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Facebook->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Facebook->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Facebook->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
	<?php if ($footerkiri->sortUrl($footerkiri->Instagram) == "") { ?>
		<th data-name="Instagram" class="<?php echo $footerkiri->Instagram->headerCellClass() ?>"><div id="elh_footerkiri_Instagram" class="footerkiri_Instagram"><div class="ew-table-header-caption"><?php echo $footerkiri->Instagram->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Instagram" class="<?php echo $footerkiri->Instagram->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->Instagram) ?>',1);"><div id="elh_footerkiri_Instagram" class="footerkiri_Instagram">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->Instagram->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->Instagram->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->Instagram->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
	<?php if ($footerkiri->sortUrl($footerkiri->LinkedIn) == "") { ?>
		<th data-name="LinkedIn" class="<?php echo $footerkiri->LinkedIn->headerCellClass() ?>"><div id="elh_footerkiri_LinkedIn" class="footerkiri_LinkedIn"><div class="ew-table-header-caption"><?php echo $footerkiri->LinkedIn->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LinkedIn" class="<?php echo $footerkiri->LinkedIn->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $footerkiri->SortUrl($footerkiri->LinkedIn) ?>',1);"><div id="elh_footerkiri_LinkedIn" class="footerkiri_LinkedIn">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $footerkiri->LinkedIn->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($footerkiri->LinkedIn->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($footerkiri->LinkedIn->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$footerkiri_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($footerkiri->ExportAll && $footerkiri->isExport()) {
	$footerkiri_list->StopRec = $footerkiri_list->TotalRecs;
} else {

	// Set the last record to display
	if ($footerkiri_list->TotalRecs > $footerkiri_list->StartRec + $footerkiri_list->DisplayRecs - 1)
		$footerkiri_list->StopRec = $footerkiri_list->StartRec + $footerkiri_list->DisplayRecs - 1;
	else
		$footerkiri_list->StopRec = $footerkiri_list->TotalRecs;
}
$footerkiri_list->RecCnt = $footerkiri_list->StartRec - 1;
if ($footerkiri_list->Recordset && !$footerkiri_list->Recordset->EOF) {
	$footerkiri_list->Recordset->moveFirst();
	$selectLimit = $footerkiri_list->UseSelectLimit;
	if (!$selectLimit && $footerkiri_list->StartRec > 1)
		$footerkiri_list->Recordset->move($footerkiri_list->StartRec - 1);
} elseif (!$footerkiri->AllowAddDeleteRow && $footerkiri_list->StopRec == 0) {
	$footerkiri_list->StopRec = $footerkiri->GridAddRowCount;
}

// Initialize aggregate
$footerkiri->RowType = ROWTYPE_AGGREGATEINIT;
$footerkiri->resetAttributes();
$footerkiri_list->renderRow();
while ($footerkiri_list->RecCnt < $footerkiri_list->StopRec) {
	$footerkiri_list->RecCnt++;
	if ($footerkiri_list->RecCnt >= $footerkiri_list->StartRec) {
		$footerkiri_list->RowCnt++;

		// Set up key count
		$footerkiri_list->KeyCount = $footerkiri_list->RowIndex;

		// Init row class and style
		$footerkiri->resetAttributes();
		$footerkiri->CssClass = "";
		if ($footerkiri->isGridAdd()) {
		} else {
			$footerkiri_list->loadRowValues($footerkiri_list->Recordset); // Load row values
		}
		$footerkiri->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$footerkiri->RowAttrs = array_merge($footerkiri->RowAttrs, array('data-rowindex'=>$footerkiri_list->RowCnt, 'id'=>'r' . $footerkiri_list->RowCnt . '_footerkiri', 'data-rowtype'=>$footerkiri->RowType));

		// Render row
		$footerkiri_list->renderRow();

		// Render list options
		$footerkiri_list->renderListOptions();
?>
	<tr<?php echo $footerkiri->rowAttributes() ?>>
<?php

// Render list options (body, left)
$footerkiri_list->ListOptions->render("body", "left", $footerkiri_list->RowCnt);
?>
	<?php if ($footerkiri->Judul->Visible) { // Judul ?>
		<td data-name="Judul"<?php echo $footerkiri->Judul->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Judul" class="footerkiri_Judul">
<span<?php echo $footerkiri->Judul->viewAttributes() ?>>
<?php echo $footerkiri->Judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Isi->Visible) { // Isi ?>
		<td data-name="Isi"<?php echo $footerkiri->Isi->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Isi" class="footerkiri_Isi">
<span<?php echo $footerkiri->Isi->viewAttributes() ?>>
<?php echo $footerkiri->Isi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Isi2->Visible) { // Isi2 ?>
		<td data-name="Isi2"<?php echo $footerkiri->Isi2->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Isi2" class="footerkiri_Isi2">
<span<?php echo $footerkiri->Isi2->viewAttributes() ?>>
<?php echo $footerkiri->Isi2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Phone->Visible) { // Phone ?>
		<td data-name="Phone"<?php echo $footerkiri->Phone->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Phone" class="footerkiri_Phone">
<span<?php echo $footerkiri->Phone->viewAttributes() ?>>
<?php echo $footerkiri->Phone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->_Email->Visible) { // Email ?>
		<td data-name="_Email"<?php echo $footerkiri->_Email->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri__Email" class="footerkiri__Email">
<span<?php echo $footerkiri->_Email->viewAttributes() ?>>
<?php echo $footerkiri->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Twitter->Visible) { // Twitter ?>
		<td data-name="Twitter"<?php echo $footerkiri->Twitter->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Twitter" class="footerkiri_Twitter">
<span<?php echo $footerkiri->Twitter->viewAttributes() ?>>
<?php echo $footerkiri->Twitter->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Facebook->Visible) { // Facebook ?>
		<td data-name="Facebook"<?php echo $footerkiri->Facebook->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Facebook" class="footerkiri_Facebook">
<span<?php echo $footerkiri->Facebook->viewAttributes() ?>>
<?php echo $footerkiri->Facebook->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->Instagram->Visible) { // Instagram ?>
		<td data-name="Instagram"<?php echo $footerkiri->Instagram->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_Instagram" class="footerkiri_Instagram">
<span<?php echo $footerkiri->Instagram->viewAttributes() ?>>
<?php echo $footerkiri->Instagram->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($footerkiri->LinkedIn->Visible) { // LinkedIn ?>
		<td data-name="LinkedIn"<?php echo $footerkiri->LinkedIn->cellAttributes() ?>>
<span id="el<?php echo $footerkiri_list->RowCnt ?>_footerkiri_LinkedIn" class="footerkiri_LinkedIn">
<span<?php echo $footerkiri->LinkedIn->viewAttributes() ?>>
<?php echo $footerkiri->LinkedIn->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$footerkiri_list->ListOptions->render("body", "right", $footerkiri_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$footerkiri->isGridAdd())
		$footerkiri_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$footerkiri->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($footerkiri_list->Recordset)
	$footerkiri_list->Recordset->Close();
?>
<?php if (!$footerkiri->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$footerkiri->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($footerkiri_list->Pager)) $footerkiri_list->Pager = new PrevNextPager($footerkiri_list->StartRec, $footerkiri_list->DisplayRecs, $footerkiri_list->TotalRecs, $footerkiri_list->AutoHidePager) ?>
<?php if ($footerkiri_list->Pager->RecordCount > 0 && $footerkiri_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($footerkiri_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($footerkiri_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $footerkiri_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($footerkiri_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($footerkiri_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $footerkiri_list->pageUrl() ?>start=<?php echo $footerkiri_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $footerkiri_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($footerkiri_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $footerkiri_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $footerkiri_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $footerkiri_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $footerkiri_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($footerkiri_list->TotalRecs == 0 && !$footerkiri->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $footerkiri_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$footerkiri_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$footerkiri->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$footerkiri_list->terminate();
?>