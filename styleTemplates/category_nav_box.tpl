BEGIN: categories -->

<ul>

<!-- BEGIN: category_loop -->

	<!-- BEGIN: has_no_father -->

		<li>{CAT_NAME}

			<ul><li>{CHILD_CAT_NAME}

				<!-- BEGIN: grand_child -->

					<ul><li>{GRAND_CHILD_CAT_NAME}</li></ul>

				<!-- END: grand_child -->

			</li></ul>

		</li>

	<!-- END: has_no_father -->

	<!-- BEGIN: has_father -->

		<!-- BEGIN: has_no_grand_father -->

			<li>{FATHER_CAT_NAME}

				<ul><li>{CAT_NAME}</li></ul>

			</li>

		<!-- END: has_no_grand_father -->

		<!-- BEGIN: has_grand_father -->

			<li>{GRAND_FATHER_CAT_NAME}

				<ul><li>{FATHER_CAT_NAME}

					<!-- BEGIN: sub_loop -->

					<ul><li>{CAT_NAME}</li></ul>

					<!-- END: sub_loop -->

				</li></ul>

			</li>

		<!-- END: has_grand_father -->

	<!-- END: has_father -->

<!-- END: category_loop -->

</ul>

<!-- END: categories