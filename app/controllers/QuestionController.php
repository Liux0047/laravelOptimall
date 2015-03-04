<?php

/**
 * Created by PhpStorm.
 * User: Allen
 * Date: 10/9/2014
 * Time: 3:18 PM
 */
class QuestionController extends BaseController
{

    public function postAskQuestion()
    {
        $validator = $this->validateAskQuestion();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $question = new ProductQuestion;
        $question->question = Input::get('question');
        $question->member_id = Auth::id();
        $question->model_id = Input::get('model_id');
        $question->is_presentable = 0;
        $question->save();

        if (isset($question->product_question_id)) {
            return Redirect::back()->with('status', '问题已经提交成功，我们的客服会通过邮箱回答您的问题');
        } else {
            return Redirect::back()->with('error', '问题提交失败，请检查网络连接');
        }

    }

    public function postAnswerQuestion()
    {

        $validator = $this->validateAnswerQuestion();

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $question = ProductQuestion::findOrFail(Input::get('question_id'));
        $question->answer = Input::get('answer');
        $question->save();

        $data['question'] = $question->question;
        $data['answer'] = $question->answer;
        $data['nickname'] = $question->member->nickname;
        $email = $question->member->email;

        if(!empty($email)){
            Mail::send('emails.member.question-answer', $data, function($message) use ($email) {
                $message->to($email)->subject('目光之城有问必答');
            });
        }

        return Redirect::back()->with('status', '回答问题成功');
    }


    public function postPresentQuestion () {

        $question = ProductQuestion::findOrFail(Input::get('question_id'));
        $question->is_presentable = 1;
        $question->save();

        return Redirect::back()->with('status', '问题展示成功');

    }

    private function validateAskQuestion()
    {
        $rules = array(
            'question' => 'required|max:200'
        );
        return Validator::make(Input::all(), $rules);

    }

    private function validateAnswerQuestion()
    {
        $rules = array(
            'answer' => 'required|max:200'
        );
        return Validator::make(Input::all(), $rules);

    }
} 