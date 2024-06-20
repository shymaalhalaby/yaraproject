<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\member;

class memberController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'member';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new member());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('password', __('Password'));
        $grid->column('ProfileImage', __('ProfileImage'));
        $grid->column('gender', __('Gender'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('Age', __('Age'));
        $grid->column('illness', __('Illness'));
        $grid->column('GOAL', __('GOAL'));
        $grid->column('Physical_case', __('Physical case'));
        $grid->column('Hieght', __('Hieght'));
        $grid->column('Wieght', __('Wieght'));
        $grid->column('target_Wieght', __('Target Wieght'));
        $grid->column('AT', __('AT'));
        $grid->column('user_id', __('User id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(member::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
        $show->field('ProfileImage', __('ProfileImage'));
        $show->field('gender', __('Gender'));
        $show->field('phone_number', __('Phone number'));
        $show->field('Age', __('Age'));
        $show->field('illness', __('Illness'));
        $show->field('GOAL', __('GOAL'));
        $show->field('Physical_case', __('Physical case'));
        $show->field('Hieght', __('Hieght'));
        $show->field('Wieght', __('Wieght'));
        $show->field('target_Wieght', __('Target Wieght'));
        $show->field('AT', __('AT'));
        $show->field('user_id', __('User id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new member());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'));
        $form->text('ProfileImage', __('ProfileImage'));
        $form->text('gender', __('Gender'));
        $form->number('phone_number', __('Phone number'));
        $form->number('Age', __('Age'));
        $form->textarea('illness', __('Illness'));
        $form->textarea('GOAL', __('GOAL'));
        $form->textarea('Physical_case', __('Physical case'));
        $form->decimal('Hieght', __('Hieght'));
        $form->decimal('Wieght', __('Wieght'));
        $form->decimal('target_Wieght', __('Target Wieght'));
        $form->text('AT', __('AT'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
