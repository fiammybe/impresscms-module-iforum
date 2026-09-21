<?php
declare(strict_types=1);

defined('ICMS_ROOT_PATH') or exit();

class IforumReportForm
{
    public static function create(int $pid, int $postId, int $topicId, int $forumId, string $viewmode, string $order)
    {
        $form = new icms_form_Theme('', 'reportform', 'report.php');
        $form->addElement(new icms_form_elements_Text(_MD_REPORT_TEXT, 'report_text', 80, 255), true);
        $form->addElement(new icms_form_elements_Hidden('pid', $pid));
        $form->addElement(new icms_form_elements_Hidden('post_id', $postId));
        $form->addElement(new icms_form_elements_Hidden('topic_id', $topicId));
        $form->addElement(new icms_form_elements_Hidden('forum', $forumId));
        $form->addElement(new icms_form_elements_Hidden('viewmode', $viewmode));
        $form->addElement(new icms_form_elements_Hidden('order', $order));

        $button_tray = new icms_form_elements_Tray('', '');
        $submit_button = new icms_form_elements_Button('', 'submit', _SUBMIT, 'submit');
        $cancel_button = new icms_form_elements_Button('', 'cancel', _MD_CANCELPOST, 'button');
        $extra = 'viewtopic.php?' . http_build_query(array(
            'forum' => $forumId,
            'topic_id' => $topicId,
            'post_id' => $postId,
            'order' => $order,
            'viewmode' => $viewmode,
        ));
        $cancel_button->setExtra("onclick='location.href=" . htmlspecialchars(json_encode($extra), ENT_QUOTES) . ";'");
        $button_tray->addElement($submit_button);
        $button_tray->addElement($cancel_button);
        $form->addElement($button_tray);

        return $form;
    }
}
