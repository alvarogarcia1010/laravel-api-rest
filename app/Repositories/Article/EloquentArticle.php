<?php

/**
 * @file
 * EloquentArticle
 *
 * All code is copyright by the original authors and released under the GNU Aferro General Public License version 3 (AGPLv3) or later.
 * See COPYRIGHT and LICENSE.
 */

namespace App\Repositories\Article;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Article;

class EloquentArticle implements ArticleInterface {

	/**
	* Article
	*
	* @var App\Models\Article;
	*
	*/
	protected $Article;

	public function __construct(Model $Article)
	{
		$this->Article = $Article;
	}

    /**
    * Retrieve list of article
    *
    * @param  int $id Organization id
    *
    * @return Illuminate\Database\Eloquent\Collection
    */
    public function searchTableRowsWithPagination($count = false, $limit = null, $offset = null, $filter = null, $sortColumn = null, $sortOrder = null)
    {
        $query = $this->Article->select('*');

        if(!empty($filter))
        {
          $query->where(function($dbQuery) use ($filter)
          {
            foreach (['sku', 'name'] as $key => $value)
            {
                $dbQuery->orWhere($value, 'like', '%' . str_replace(' ', '%', $filter) . '%');
                //$dbQuery->orwhereRaw('lower(`' . $value . '`) LIKE ? ',['%' . strtolower(str_replace(' ', '%', $filter)) . '%']);
            }
          });
        }

        if(!empty($sortColumn) && !empty($sortOrder))
        {
          $query->orderBy($sortColumn, $sortOrder);
        }

        if($count)
        {
            return $query->count();
        }

        if(!empty($limit))
        {
            $query->take($limit);
        }

        if(!empty($offset) && $offset != 0)
        {
            $query->skip($offset);
        }
        return new Collection(
            $query->get()
        );
    }

    /**
     * Get an article by id
    *
    * @param  int $id
    *
    * @return Mgallegos\DecimaAccounting\Account
    */
    public function byId($id)
    {
        return $this->Article->find($id);
    }

    /**
     * Create a new Article
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @return App\Models\Article $Article
    */
    public function create(array  $data)
    {
        $article = new Article();
        $article->fill($data)->save();

        return $article;
    }

    /**
     * Update an existing Article
    *
    * @param array $data
    * 	An array as follows: array('field0'=>$field0, 'field1'=>$field1);
    *
    * @param App\Models\Article $article
    *
    * @return boolean
    */
    public function update(array $data, $article = null)
    {
        if(empty($article))
        {
            $article = $this->byId($data['id']);
        }

        return $article->update($data);
    }

    /**
     * Delete existing Article
    *
    * @param integer $id
    * 	An article id
    *
    * @return boolean
    */
    public function delete(array $ids)
    {
        return $this->Article->destroy($ids);
    }
}
