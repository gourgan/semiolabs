<?php


/**
 * Base class that represents a query for the 'tag_article' table.
 *
 *
 *
 * @method TagArticleQuery orderByIdArticle($order = Criteria::ASC) Order by the id_article column
 * @method TagArticleQuery orderByIdTag($order = Criteria::ASC) Order by the id_tag column
 *
 * @method TagArticleQuery groupByIdArticle() Group by the id_article column
 * @method TagArticleQuery groupByIdTag() Group by the id_tag column
 *
 * @method TagArticleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TagArticleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TagArticleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TagArticleQuery leftJoinTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tag relation
 * @method TagArticleQuery rightJoinTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tag relation
 * @method TagArticleQuery innerJoinTag($relationAlias = null) Adds a INNER JOIN clause to the query using the Tag relation
 *
 * @method TagArticleQuery leftJoinArticle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Article relation
 * @method TagArticleQuery rightJoinArticle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Article relation
 * @method TagArticleQuery innerJoinArticle($relationAlias = null) Adds a INNER JOIN clause to the query using the Article relation
 *
 * @method TagArticle findOne(PropelPDO $con = null) Return the first TagArticle matching the query
 * @method TagArticle findOneOrCreate(PropelPDO $con = null) Return the first TagArticle matching the query, or a new TagArticle object populated from the query conditions when no match is found
 *
 * @method TagArticle findOneByIdArticle(int $id_article) Return the first TagArticle filtered by the id_article column
 * @method TagArticle findOneByIdTag(int $id_tag) Return the first TagArticle filtered by the id_tag column
 *
 * @method array findByIdArticle(int $id_article) Return TagArticle objects filtered by the id_article column
 * @method array findByIdTag(int $id_tag) Return TagArticle objects filtered by the id_tag column
 *
 * @package    propel.generator.semiolabs.om
 */
abstract class BaseTagArticleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTagArticleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'semio', $modelName = 'TagArticle', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TagArticleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TagArticleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TagArticleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TagArticleQuery) {
            return $criteria;
        }
        $query = new TagArticleQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$id_article, $id_tag]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   TagArticle|TagArticle[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TagArticlePeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TagArticlePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 TagArticle A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id_article`, `id_tag` FROM `tag_article` WHERE `id_article` = :p0 AND `id_tag` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new TagArticle();
            $obj->hydrate($row);
            TagArticlePeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return TagArticle|TagArticle[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|TagArticle[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(TagArticlePeer::ID_ARTICLE, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(TagArticlePeer::ID_TAG, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(TagArticlePeer::ID_ARTICLE, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(TagArticlePeer::ID_TAG, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the id_article column
     *
     * Example usage:
     * <code>
     * $query->filterByIdArticle(1234); // WHERE id_article = 1234
     * $query->filterByIdArticle(array(12, 34)); // WHERE id_article IN (12, 34)
     * $query->filterByIdArticle(array('min' => 12)); // WHERE id_article >= 12
     * $query->filterByIdArticle(array('max' => 12)); // WHERE id_article <= 12
     * </code>
     *
     * @see       filterByArticle()
     *
     * @param     mixed $idArticle The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function filterByIdArticle($idArticle = null, $comparison = null)
    {
        if (is_array($idArticle)) {
            $useMinMax = false;
            if (isset($idArticle['min'])) {
                $this->addUsingAlias(TagArticlePeer::ID_ARTICLE, $idArticle['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idArticle['max'])) {
                $this->addUsingAlias(TagArticlePeer::ID_ARTICLE, $idArticle['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TagArticlePeer::ID_ARTICLE, $idArticle, $comparison);
    }

    /**
     * Filter the query on the id_tag column
     *
     * Example usage:
     * <code>
     * $query->filterByIdTag(1234); // WHERE id_tag = 1234
     * $query->filterByIdTag(array(12, 34)); // WHERE id_tag IN (12, 34)
     * $query->filterByIdTag(array('min' => 12)); // WHERE id_tag >= 12
     * $query->filterByIdTag(array('max' => 12)); // WHERE id_tag <= 12
     * </code>
     *
     * @see       filterByTag()
     *
     * @param     mixed $idTag The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function filterByIdTag($idTag = null, $comparison = null)
    {
        if (is_array($idTag)) {
            $useMinMax = false;
            if (isset($idTag['min'])) {
                $this->addUsingAlias(TagArticlePeer::ID_TAG, $idTag['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idTag['max'])) {
                $this->addUsingAlias(TagArticlePeer::ID_TAG, $idTag['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TagArticlePeer::ID_TAG, $idTag, $comparison);
    }

    /**
     * Filter the query by a related Tag object
     *
     * @param   Tag|PropelObjectCollection $tag The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TagArticleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTag($tag, $comparison = null)
    {
        if ($tag instanceof Tag) {
            return $this
                ->addUsingAlias(TagArticlePeer::ID_TAG, $tag->getId(), $comparison);
        } elseif ($tag instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TagArticlePeer::ID_TAG, $tag->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTag() only accepts arguments of type Tag or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function joinTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tag');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Tag');
        }

        return $this;
    }

    /**
     * Use the Tag relation Tag object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TagQuery A secondary query class using the current class as primary query
     */
    public function useTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tag', 'TagQuery');
    }

    /**
     * Filter the query by a related Article object
     *
     * @param   Article|PropelObjectCollection $article The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TagArticleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByArticle($article, $comparison = null)
    {
        if ($article instanceof Article) {
            return $this
                ->addUsingAlias(TagArticlePeer::ID_ARTICLE, $article->getId(), $comparison);
        } elseif ($article instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TagArticlePeer::ID_ARTICLE, $article->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByArticle() only accepts arguments of type Article or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Article relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function joinArticle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Article');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Article');
        }

        return $this;
    }

    /**
     * Use the Article relation Article object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ArticleQuery A secondary query class using the current class as primary query
     */
    public function useArticleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArticle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Article', 'ArticleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TagArticle $tagArticle Object to remove from the list of results
     *
     * @return TagArticleQuery The current query, for fluid interface
     */
    public function prune($tagArticle = null)
    {
        if ($tagArticle) {
            $this->addCond('pruneCond0', $this->getAliasedColName(TagArticlePeer::ID_ARTICLE), $tagArticle->getIdArticle(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(TagArticlePeer::ID_TAG), $tagArticle->getIdTag(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
