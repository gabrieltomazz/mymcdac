(function ($) {

	if (localStorage) {


		$(".treeview-menu > li, .menu-leaf").click(function () {
			localStorage.setItem("last-menu", this.id);
		});

		var lastAccessed = localStorage.getItem("last-menu");

		if (lastAccessed && lastAccessed != "menu-painel") {

			$("#" + lastAccessed).addClass('active');
			$("#" + lastAccessed).parent().parent().addClass('active');

		} else {
			$("#menu-painel").addClass('active');
		}

	}

})(jQuery);