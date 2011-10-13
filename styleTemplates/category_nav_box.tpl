<!-- BEGIN: categories -->

<!-- BEGIN: category_loop -->

	<!-- BEGIN: has_no_father -->

	<ul>

		<li>{CAT_NAME}

			<ul><li>{CHILD_CAT_NAME}

				<!-- BEGIN: has_grand_child -->

					<ul><li>{GRAND_CHILD_CAT_NAME}</li></ul>

				<!-- END: has_grand_child -->

			</li></ul>

		</li>

	</ul>

	<!-- END: has_no_father -->

	<!-- BEGIN: has_father -->

		<!-- BEGIN: has_no_grand_father -->

		<ul>

			<li>{FATHER_CAT_NAME}

				<ul><li>{CAT_NAME}</li></ul>

			</li>

		</ul>

		<!-- END: has_no_grand_father -->

		<!-- BEGIN: has_grand_father -->

		<ul>

			<li>{GRAND_FATHER_CAT_NAME}

				<ul><li>{FATHER_CAT_NAME}

					<ul><li>CAT_NAME}</li></ul>

				</li></ul>

			</li>

		</ul>

		<!-- END: has_grand_father -->

	<!-- END: has_father -->

<!-- END: category_loop -->

<!-- END: categories -->