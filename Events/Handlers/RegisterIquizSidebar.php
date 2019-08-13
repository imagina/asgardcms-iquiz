<?php

namespace Modules\Iquiz\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIquizSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        //$sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('iquiz::iquizzes.title.iquizzes'), function (Item $item) {
                $item->icon('fa fa-copy');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('iquiz::polls.title.polls'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquiz.poll.create');
                    $item->route('admin.iquiz.poll.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquiz.polls.index')
                    );
                });
                $item->item(trans('iquiz::questions.title.questions'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquiz.question.create');
                    $item->route('admin.iquiz.question.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquiz.questions.index')
                    );
                });
                $item->item(trans('iquiz::answers.title.answers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquiz.answer.create');
                    $item->route('admin.iquiz.answer.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquiz.answers.index')
                    );
                });
                $item->item(trans('iquiz::userquestionanswers.title.userquestionanswers'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquiz.userquestionanswer.create');
                    $item->route('admin.iquiz.userquestionanswer.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquiz.userquestionanswers.index')
                    );
                });
                $item->item(trans('iquiz::userpolls.title.userpolls'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iquiz.userpoll.create');
                    $item->route('admin.iquiz.userpoll.index');
                    $item->authorize(
                        $this->auth->hasAccess('iquiz.userpolls.index')
                    );
                });
// append





            });
        });

        return $menu;
    }
}
