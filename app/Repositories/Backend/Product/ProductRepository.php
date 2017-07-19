<?php

namespace App\Repositories\Backend\Product;

use App\Models\Product\Product as Model;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;

use Image;
use File;
/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Model::class;

    /**
     * @var Product Model
     */
    protected $model;

    /**
     * @var History slug $history_slug
     */
    protected $history_slug = 'Product';

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param Request  $request
     *
     * @return mixed
     */
    public function getForDataTable($request)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        return $this->query()
            ->select([
                'id',
                'name',
                'brand_id',
                'image',
                'slug',
            ]);
    }
   
}
