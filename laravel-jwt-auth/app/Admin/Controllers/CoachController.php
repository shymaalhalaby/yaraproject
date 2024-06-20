<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\coach;

class CoachController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'coach';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new coach());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('password', __('Password'));
        $grid->column('ProfileImage', __('ProfileImage'));
        $grid->column('gender', __('Gender'));
        $grid->column('Age', __('Age'));
        $grid->column('phone_number', __('Phone number'));
        $grid->column('WorkHours', __('WorkHours'));
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
        $show = new Show(coach::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('password', __('Password'));
        $show->field('ProfileImage', __('ProfileImage'));
        $show->field('gender', __('Gender'));
        $show->field('Age', __('Age'));
        $show->field('phone_number', __('Phone number'));
        $show->field('WorkHours', __('WorkHours'));
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
        $form = new Form(new coach());

        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'));
        $form->text('ProfileImage', __('ProfileImage'));
        $form->text('gender', __('Gender'));
        $form->number('Age', __('Age'));
        $form->number('phone_number', __('Phone number'));
        $form->time('WorkHours', __('WorkHours'))->default(date('H:i:s'));
        $form->number('user_id', __('User id'));

        return $form;
    }
}
