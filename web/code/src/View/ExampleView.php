<?php

declare(strict_types = 1);

namespace Example\View;

use Example\Model\ExampleModel;
use Mini\Controller\Exception\BadInputException;

/**
 * Example view builder.
 */
class ExampleView
{
    /**
     * Example data.
     *
     * @var Example\Model\ExampleModel|null
     */
    protected $model = null;

    /**
     * Setup.
     *
     * @param ExampleModel $model example data
     */
    public function __construct(ExampleModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get the example view to display its data.
     * @param ExampleModel $model
     * @return string
     * @throws BadInputException
     */
    public function get(ExampleModel $model): string
    {
        if(!$model->get('id') || $model->getCode() || !$model->getDescription() || !$model->getCreated()) {
            throw new BadInputException('Model not found');
        }
        return view('app/example/detail', $model);
    }
}
