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
$portofolio_list = new portofolio_list();

// Run the page
$portofolio_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$portofolio_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$portofolio->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fportofoliolist = currentForm = new ew.Form("fportofoliolist", "list");
fportofoliolist.formKeyCountName = '<?php echo $portofolio_list->FormKeyCountName ?>';

// Form_CustomValidate event
fportofoliolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fportofoliolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fportofoliolistsrch = currentSearchForm = new ew.Form("fportofoliolistsrch");

// Filters
fportofoliolistsrch.filterList = <?php echo $portofolio_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$portofolio->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($portofolio_list->TotalRecs > 0 && $portofolio_list->ExportOptions->visible()) { ?>
<?php $portofolio_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($portofolio_list->ImportOptions->visible()) { ?>
<?php $portofolio_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($portofolio_list->SearchOptions->visible()) { ?>
<?php $portofolio_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($portofolio_list->FilterOptions->visible()) { ?>
<?php $portofolio_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$portofolio_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$portofolio->isExport() && !$portofolio->CurrentAction) { ?>
<form name="fportofoliolistsrch" id="fportofoliolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($portofolio_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fportofoliolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="portofolio">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($portofolio_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($portofolio_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $portofolio_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($portofolio_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($portofolio_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($portofolio_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($portofolio_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $portofolio_list->showPageHeader(); ?>
<?php
$portofolio_list->showMessage();
?>
<?php if ($portofolio_list->TotalRecs > 0 || $portofolio->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($portofolio_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> portofolio">
<?php if (!$portofolio->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$portofolio->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portofolio_list->Pager)) $portofolio_list->Pager = new PrevNextPager($portofolio_list->StartRec, $portofolio_list->DisplayRecs, $portofolio_list->TotalRecs, $portofolio_list->AutoHidePager) ?>
<?php if ($portofolio_list->Pager->RecordCount > 0 && $portofolio_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($portofolio_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $portofolio_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $portofolio_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $portofolio_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $portofolio_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fportofoliolist" id="fportofoliolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($portofolio_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $portofolio_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="portofolio">
<div id="gmp_portofolio" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($portofolio_list->TotalRecs > 0 || $portofolio->isGridEdit()) { ?>
<table id="tbl_portofoliolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$portofolio_list->RowType = ROWTYPE_HEADER;

// Render list options
$portofolio_list->renderListOptions();

// Render list options (header, left)
$portofolio_list->ListOptions->render("header", "left");
?>
<?php if ($portofolio->Judul->Visible) { // Judul ?>
	<?php if ($portofolio->sortUrl($portofolio->Judul) == "") { ?>
		<th data-name="Judul" class="<?php echo $portofolio->Judul->headerCellClass() ?>"><div id="elh_portofolio_Judul" class="portofolio_Judul"><div class="ew-table-header-caption"><?php echo $portofolio->Judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Judul" class="<?php echo $portofolio->Judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $portofolio->SortUrl($portofolio->Judul) ?>',1);"><div id="elh_portofolio_Judul" class="portofolio_Judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $portofolio->Judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($portofolio->Judul->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($portofolio->Judul->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
	<?php if ($portofolio->sortUrl($portofolio->Gambar) == "") { ?>
		<th data-name="Gambar" class="<?php echo $portofolio->Gambar->headerCellClass() ?>"><div id="elh_portofolio_Gambar" class="portofolio_Gambar"><div class="ew-table-header-caption"><?php echo $portofolio->Gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Gambar" class="<?php echo $portofolio->Gambar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $portofolio->SortUrl($portofolio->Gambar) ?>',1);"><div id="elh_portofolio_Gambar" class="portofolio_Gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $portofolio->Gambar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($portofolio->Gambar->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($portofolio->Gambar->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$portofolio_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($portofolio->ExportAll && $portofolio->isExport()) {
	$portofolio_list->StopRec = $portofolio_list->TotalRecs;
} else {

	// Set the last record to display
	if ($portofolio_list->TotalRecs > $portofolio_list->StartRec + $portofolio_list->DisplayRecs - 1)
		$portofolio_list->StopRec = $portofolio_list->StartRec + $portofolio_list->DisplayRecs - 1;
	else
		$portofolio_list->StopRec = $portofolio_list->TotalRecs;
}
$portofolio_list->RecCnt = $portofolio_list->StartRec - 1;
if ($portofolio_list->Recordset && !$portofolio_list->Recordset->EOF) {
	$portofolio_list->Recordset->moveFirst();
	$selectLimit = $portofolio_list->UseSelectLimit;
	if (!$selectLimit && $portofolio_list->StartRec > 1)
		$portofolio_list->Recordset->move($portofolio_list->StartRec - 1);
} elseif (!$portofolio->AllowAddDeleteRow && $portofolio_list->StopRec == 0) {
	$portofolio_list->StopRec = $portofolio->GridAddRowCount;
}

// Initialize aggregate
$portofolio->RowType = ROWTYPE_AGGREGATEINIT;
$portofolio->resetAttributes();
$portofolio_list->renderRow();
while ($portofolio_list->RecCnt < $portofolio_list->StopRec) {
	$portofolio_list->RecCnt++;
	if ($portofolio_list->RecCnt >= $portofolio_list->StartRec) {
		$portofolio_list->RowCnt++;

		// Set up key count
		$portofolio_list->KeyCount = $portofolio_list->RowIndex;

		// Init row class and style
		$portofolio->resetAttributes();
		$portofolio->CssClass = "";
		if ($portofolio->isGridAdd()) {
		} else {
			$portofolio_list->loadRowValues($portofolio_list->Recordset); // Load row values
		}
		$portofolio->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$portofolio->RowAttrs = array_merge($portofolio->RowAttrs, array('data-rowindex'=>$portofolio_list->RowCnt, 'id'=>'r' . $portofolio_list->RowCnt . '_portofolio', 'data-rowtype'=>$portofolio->RowType));

		// Render row
		$portofolio_list->renderRow();

		// Render list options
		$portofolio_list->renderListOptions();
?>
	<tr<?php echo $portofolio->rowAttributes() ?>>
<?php

// Render list options (body, left)
$portofolio_list->ListOptions->render("body", "left", $portofolio_list->RowCnt);
?>
	<?php if ($portofolio->Judul->Visible) { // Judul ?>
		<td data-name="Judul"<?php echo $portofolio->Judul->cellAttributes() ?>>
<span id="el<?php echo $portofolio_list->RowCnt ?>_portofolio_Judul" class="portofolio_Judul">
<span<?php echo $portofolio->Judul->viewAttributes() ?>>
<?php echo $portofolio->Judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($portofolio->Gambar->Visible) { // Gambar ?>
		<td data-name="Gambar"<?php echo $portofolio->Gambar->cellAttributes() ?>>
<span id="el<?php echo $portofolio_list->RowCnt ?>_portofolio_Gambar" class="portofolio_Gambar">
<span>
<?php echo GetFileViewTag($portofolio->Gambar, $portofolio->Gambar->getViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$portofolio_list->ListOptions->render("body", "right", $portofolio_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$portofolio->isGridAdd())
		$portofolio_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$portofolio->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($portofolio_list->Recordset)
	$portofolio_list->Recordset->Close();
?>
<?php if (!$portofolio->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$portofolio->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($portofolio_list->Pager)) $portofolio_list->Pager = new PrevNextPager($portofolio_list->StartRec, $portofolio_list->DisplayRecs, $portofolio_list->TotalRecs, $portofolio_list->AutoHidePager) ?>
<?php if ($portofolio_list->Pager->RecordCount > 0 && $portofolio_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($portofolio_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($portofolio_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $portofolio_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($portofolio_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($portofolio_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $portofolio_list->pageUrl() ?>start=<?php echo $portofolio_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $portofolio_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($portofolio_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $portofolio_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $portofolio_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $portofolio_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $portofolio_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($portofolio_list->TotalRecs == 0 && !$portofolio->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $portofolio_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$portofolio_list->showPageFooter();
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
$portofolio_list->terminate();
?>