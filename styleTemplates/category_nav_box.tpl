<!-- BEGIN: categories -->

<ul>

<!-- BEGIN: category_loop -->

	<!-- BEGIN: has_no_father -->

		<li>{CAT_NAME}<ul>

			<!-- BEGIN: child_loop -->

			 	<li>{CHILD_CAT_NAME}<ul>

					<!-- BEGIN: grand_child_loop -->

					<li>{GRAND_CHILD_CAT_NAME}</li></ul>

					<!-- END: grand_child_loop -->

					</li></ul>

			<!-- END: child_loop -->

		</li>


	<!-- END: has_no_father -->

	<!-- BEGIN: has_father -->

		<!-- BEGIN: has_no_grand_father -->

			<li>{FATHER_CAT_NAME}

				<!-- BEGIN: sub_loop -->

				<ul><li>{CAT_NAME}</li></ul>

				<!-- END: sub_loop -->

			</li>

		<!-- END: has_no_grand_father -->

		<!-- BEGIN: has_grand_father -->

			<li>{GRAND_FATHER_CAT_NAME}<ul>

				<!-- BEGIN: father_cat_loop -->

				<li>{FATHER_CAT_NAME}<ul>

					<!-- BEGIN: cat_loop -->

					<li>{CAT_NAME}</li></ul>

					<!-- END: cat_loop -->

					</li></ul>

				<!-- END: father_cat_loop -->

				</li>

		<!-- END: has_grand_father -->

	<!-- END: has_father -->

<!-- END: category_loop -->

</ul>

<!-- END: categories -->