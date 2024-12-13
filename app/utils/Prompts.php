<?php

class Prompts {
    const NEW_CODE_FOR_OLD_CODE_PROMPT = <<<EOT
  Rewrite the following php code by new design and interactivity. The project consists
   of only this one file, so avoid using external variables or files. Dont keep the main structure and
    content intact, but feel free to completely rewrite or redesign it if you have better ideas for
     layout, user interaction, or visual appeal. Any placeholder content like 'Hello World' is meant
      only as an example and should be replaced with creative, meaningful, and engaging content. You
       may include PHP, JavaScript, and CSS to enhance the user experience or design. Your response
        must ONLY include the enhanced code, without any explanations, summaries, or phrases like 'In
         this revised code.' Ensure the response does not exceed 400 characters, prioritizing creativity,
          functionality, and conciseness. Make the least amount of code you can do. Here is the code: 
EOT;

    const CODE_MUST_HAVE_PREFIX = <<<EOT
The code has to have following code in one place:
EOT;

    const REWRITE_CODE = <<<EOT
Rewrite the following code by new design and interactivity.
EOT;
    const REDESIGN_CODE = <<<EOT
Dont keep the main structure and content intact, but feel free to completely rewrite or redesign it if you have better ideas for layout, user interaction, or visual appeal.
EOT;
    const NO_SUMMARY = <<<EOT
Your response must ONLY include the enhanced code, without any explanations, summaries, or phrases like 'In this revised code.'
EOT;
    const CHARACTER_LIMIT = <<<EOT
Ensure the response does not exceed 400 characters, prioritizing creativity, functionality, and conciseness. Make the least amount of code you can do.
EOT;
    const CODE_PREFIX = <<<EOT
Here is the code:
EOT;
}