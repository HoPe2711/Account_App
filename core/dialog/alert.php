<?php
    class Alert{
        /**
         * @desc create alert notification component
         * @param Authentication $model
         */
        public static function notify($model){
            if ($model->checkErrors()){
                echo sprintf('
                        <div class="pop-up login-pop-up" id="login-pop-up">
                            <div class="pop-up-container login-pop-up-container">
                                <div class="layout">
                                    <div class="notify">
                                        <question-alert></question-alert>
                                        <div class="content">
                                            %s. Please try again.
                                        </div>
                                    </div>
                                    <div class="url" onclick="closePopUp()">&#10006;</div>
                                </div>
                                <button class="url" type="button" onclick="closePopUp()">OK</button>
                            </div>
                        </div>', $model->checkErrors());
            }
        }
    }
?>