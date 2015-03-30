<?php
	/**
	 * Default useful functions
	 * @author Antoine De Gieter
	 */

	# New line to paragraph
	function nl2p($string, $text_alignment = "justify") {
		if ($text_alignment != "justify"
		&& $text_alignment != "center"
		&& $text_alignment != "right"
		&& $text_alignment != "left")
			$text_alignment = "justify";

		$paragraphs = '';

		foreach (explode("\n\n", $string) as $line):
			if (trim($line)):
				$paragraphs .= 
					'<p class="text-' . $text_alignment . '">' . $line . '</p>';
			endif;
		endforeach;

		return preg_replace("/[\n]/", "<br>", $paragraphs);
	}

	# New line to title
	function nl2h($string, $level = "1", $text_alignment = "justify") {
		if ($text_alignment != "justify"
		&& $text_alignment != "center"
		&& $text_alignment != "right"
		&& $text_alignment != "left")
			$text_alignment = "justify";

		if ($level < 1 || $level > 6)
			$level = 1;

		$paragraphs = '';

		foreach (explode("\n\n", $string) as $line):
			if (trim($line)):
				$paragraphs .= 
					'<h' . $level . ' class="text-' . $text_alignment . '">'
					. $line . '</h' . $level . '>';
			endif;
		endforeach;

		return preg_replace("/[\n]/", "<br>", $paragraphs);
	}

	# Display language
	function displayLanguage() {
		echo $lang;
	}

	# Display author
	function displayAuthor() {
		echo '<!-- Designed by ' . DEFAULT_AUTHOR 
			. ' (' . DEFAULT_COMPANY . ') -->';
	}

