(function($) {
	function readlyPostType() {
		$('#readly_big_video_box').hide();
		$('#readly_big_audio_box').hide();
		if ($('#post-format-video:checked').length > 0) {
			$('#readly_big_video_box').show();
		}
		else if ($('#post-format-audio:checked').length > 0) {
			$('#readly_big_audio_box').show();
		}
	}

	$(function() {
		readlyPostType();
		$('input[name="post_format"]').on('change', readlyPostType);
	});
})(jQuery);
