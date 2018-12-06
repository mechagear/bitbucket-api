<?php
/**
 * @author Anton Gorlanov <antonxacc@gmail.com>
 */
namespace whotrades\BitbucketApi\Resources\Project\Repo\PullRequest;

use \whotrades\BitbucketApi\Resources\Base;
use \whotrades\BitbucketApi\Entity;
use \whotrades\BitbucketApi\Exception;
use \whotrades\BitbucketApi\Response\ResponseDiff;

class Diff extends Base
{
    protected static $resourceBaseUrl = 'diff';

    /**
     * {@inheritdoc}
     *
     * @throws Exception\MethodIsNotAcceptable
     */
    public function getEntity($resourceId = null)
    {
        throw new Exception\MethodIsNotAcceptable(__METHOD__);
    }

    /**
     * {@inheritdoc}
     */
    public function getList($parameters = null, $getAllPages = null)
    {
        $entityClass = $this->getEntityClass();

        $url = $this->getPath(null, $useResourceId = false);
        $parameters = $parameters ?? [];

        $response = new ResponseDiff($this->sendRequest($url, 'GET', $parameters));

        foreach ($response->getDiffs() as $diff) {
            yield new $entityClass($diff);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getEntityClass()
    {
        return Entity\PullRequest\Diff::class;
    }
}