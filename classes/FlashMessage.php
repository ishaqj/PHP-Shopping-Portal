<?php

class FlashMessage
{
    /**
     * Flash Message Class
     * 
     **/

    /**
     * Function for adding flash message.
     * 
     * @param string $message   message to add.
     * @param string $type      type of message.
     */
    private function addMessage($message, $type) {
        if(isset($_SESSION['flashmessages'])){
            $flashMessages = $_SESSION['flashmessages'];
        }
        $flashMessage = [
            'message' => $message,
            'type' => $type,
        ];
        $flashMessages[] = $flashMessage;
        $_SESSION['flashmessages'] = $flashMessages;
    }

    /**
     * Function for error message
     * 
     * @param string $message message.
     */
    public function addError($message) {
        $this->addMessage($message, 'alert alert-danger');
    }

    /**
     * Function for success message.
     * 
     * @param string $message message.
     */
    public function addSuccess($message) {
        $this->addMessage($message, 'alert alert-success');
    }


     /**
     * Function for deleting message
     * 
     */
    private function deleteMessages() {
        unset($_SESSION['flashmessages']);
    }

    /**
     * Function for displaying message
     *
     * @return $html
     */
    public function getFlashMessages() {
        if(isset($_SESSION['flashmessages'])){
            $messages = $_SESSION['flashmessages'];
            $html = "";
            foreach ($messages as $message) {
                $html .= "<div class='" . $message['type'] . "'>"  . $message['message'] . "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a></div>";
            }
            $this->deleteMessages();
            return $html;
        }
    }

    /**
     * Redirect to another page.
     *
     * @param string $url to redirect to
     *
     */
    public function redirect($url)
    {
        header('Location: ' . $url);
    }

} // END class
