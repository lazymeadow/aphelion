$(function() {
	$(".forumform").validate({
		submitHandler: function(form) {
			var values = (".forumform").serialize();
			console.log(values);

			(".forumform").ajaxSubmit({
					type: "POST",
					url: "../secret/forum/forumhandler.php",
					data: values,
					success: function() {
						(".forumform").prepend("SUCCESS!");
						alert("YES");
					},
					error: function() {
						(".forumform".prepend("NOPE");
						alert("NO");
					}
			});
		}
	});
});
