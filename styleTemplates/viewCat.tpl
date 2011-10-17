
<!-- BEGIN: product_cats -->

<div class="breadcrumb">
<h1><a href="{HOME_HREF}">HOME</a><span class="forward_slash"><strong>/</strong></span><a href="{CURRENT_URL}" title="{CAT_TITLE}">{CAT_NAME}</a></h1><p class="page_description">{CAT_DESCRIPTION}</p></div>

<div class="page_products">

<!-- BEGIN: products_true -->

<div class="pagination_wrap">{TOTAL_PRODUCTS}{PAGINATION}</div>

<ul class="product_loop_wrap">
<!-- BEGIN: product_loop -->
<li>
		<ul>

			<li>
			<a href="{HREF}" class="page_products_link"><img src="{IMAGE}" alt="{IMAGE}"></a>
			</li>

			<li><a href="{HREF}"
			class="page_products_link"><p class="page_products_name">{NAME}</p>
			</a></li>

			<li><p class="page_products_price">&pound;{PRICE}</p></li>

			<li><p class="vat_info">excl. VAT</p></li>

			<li><p class="page_products_stock_level">{STOCK}</p></li>

			<li>

			<form name="prod{ID}" method="post" action="{CURRENT_URL}">
			<input type="hidden" value="{ID}" name="add"/>
			<input type="hidden" value="1" name="quan"/>
			<input type="hidden" value="{CAT_ID}" name="rangeId"/>
			
			<a class="page_products_add_to_basket" target="_self" href="javascript:submitDoc('prod{ID}');">
			Add to Basket
			</a>

			</form>

			</li>

		</ul>

</li>

<!-- END: product_loop -->

</ul>


<!-- END: products_true -->


<!-- BEGIN: products_false -->

<div class="currently_no_products">

<ul> 

<li>{NO_PRODUCTS_MSG}</li>

</ul>

</div>

{HOMEPAGE_CATEGORIES}

<!-- END: products_false -->

</div>
<!-- END: product_cats -->