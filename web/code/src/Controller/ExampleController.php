<?php

declare(strict_types = 1);

namespace Example\Controller;

use Example\Model\ExampleModel;
use Example\View\ExampleView;
use Mini\Controller\Controller;
use Mini\Controller\Exception\BadInputException;
use Mini\Http\Request;

/**
 * Example entrypoint logic.
 */
class ExampleController extends Controller
{
    /**
     * Example view model.
     *
     * @var Example\Model\ExampleModel|null
     */
    protected $model = null;

    /**
     * Example view builder.
     *
     * @var Example\View\ExampleView|null
     */
    protected $view = null;

    /**
     * Setup.
     *
     * @param ExampleModel $model example data
     * @param ExampleView  $view  example view builder
     */
    public function __construct(ExampleModel $model, ExampleView $view)
    {
        $this->model = $model;
        $this->view  = $view;
    }

    public function get(Request $request) {
        ExampleModel::get();
    }

    /**
     * Create an example and display its data.
     * @param Request $request
     * @return string
     * @throws BadInputException
     */
    public function createExample(Request $request): string
    {
        $model = new ExampleModel();

        if (!$request->request->get('code')){
            throw new BadInputException('Example code missing');
        }
        $model->setCode($request->request->get('code'));

        if (!$request->request->get('description')) {
            throw new BadInputException('Example description missing');
        }
        $model->setDescription($request->request->get('description'));

        $id = $model->create();

        return $this->view->get($model);
    }
}
