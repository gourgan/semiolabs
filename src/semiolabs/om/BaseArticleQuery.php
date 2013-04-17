<?php


/**
 * Base class that represents a query for the 'article' table.
 *
 *
 *
 * @method ArticleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method ArticleQuery orderByTitre($order = Criteria::ASC) Order by the titre column
 * @method ArticleQuery orderByTexte($order = Criteria::ASC) Order by the texte column
 * @method ArticleQuery orderByDate($order = Criteria::ASC) Order by the date column
 * @method ArticleQuery orderByMedia($order = Criteria::ASC) Order by the media column
 * @method ArticleQuery orderByLien($order = Criteria::ASC) Order by the lien column
 * @method ArticleQuery orderByTypeId($order = Criteria::ASC) Order by the type_id column
 * @method ArticleQuery orderByAuteurId($order = Criteria::ASC) Order by the auteur_id column
 * @method ArticleQuery orderByTags($order = Criteria::ASC) Order by the tags column
 * @method ArticleQuery orderByNbVue($order = Criteria::ASC) Order by the nb_vue column
 *
 * @method ArticleQuery groupById() Group by the id column
 * @method ArticleQuery groupByTitre() Group by the titre column
 * @method ArticleQuery groupByTexte() Group by the texte column
 * @method ArticleQuery groupByDate() Group by the date column
 * @method ArticleQuery groupByMedia() Group by the media column
 * @method ArticleQuery groupByLien() Group by the lien column
 * @method ArticleQuery groupByTypeId() Group by the type_id column
 * @method ArticleQuery groupByAuteurId() Group by the auteur_id column
 * @method ArticleQuery groupByTags() Group by the tags column
 * @method ArticleQuery groupByNbVue() Group by the nb_vue column
 *
 * @method ArticleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ArticleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ArticleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ArticleQuery leftJoinType($relationAlias = null) Adds a LEFT JOIN clause to the query using the Type relation
 * @method ArticleQuery rightJoinType($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Type relation
 * @method ArticleQuery innerJoinType($relationAlias = null) Adds a INNER JOIN clause to the query using the Type relation
 *
 * @method ArticleQuery leftJoinAuteur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Auteur relation
 * @method ArticleQuery rightJoinAuteur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Auteur relation
 * @method ArticleQuery innerJoinAuteur($relationAlias = null) Adds a INNER JOIN clause to the query using the Auteur relation
 *
 * @method Article findOne(PropelPDO $con = null) Return the first Article matching the query
 * @method Article findOneOrCreate(PropelPDO $con = null) Return the first Article matching the query, or a new Article object populated from the query conditions when no match is found
 *
 * @method Article findOneByTitre(string $titre) Return the first Article filtered by the titre column
 * @method Article findOneByTexte(string $texte) Return the first Article filtered by the texte column
 * @method Article findOneByDate(string $date) Return the first Article filtered by the date column
 * @method Article findOneByMedia(string $media) Return the first Article filtered by the media column
 * @method Article findOneByLien(string $lien) Return the first Article filtered by the lien column
 * @method Article findOneByTypeId(int $type_id) Return the first Article filtered by the type_id column
 * @method Article findOneByAuteurId(int $auteur_id) Return the first Article filtered by the auteur_id column
 * @method Article findOneByTags(string $tags) Return the first Article filtered by the tags column
 * @method Article findOneByNbVue(int $nb_vue) Return the first Article filtered by the nb_vue column
 *
 * @method array findById(int $id) Return Article objects filtered by the id column
 * @method array findByTitre(string $titre) Return Article objects filtered by the titre column
 * @method array findByTexte(string $texte) Return Article objects filtered by the texte column
 * @method array findByDate(string $date) Return Article objects filtered by the date column
 * @method array findByMedia(string $media) Return Article objects filtered by the media column
 * @method array findByLien(string $lien) Return Article objects filtered by the lien column
 * @method array findByTypeId(int $type_id) Return Article objects filtered by the type_id column
 * @method array findByAuteurId(int $auteur_id) Return Article objects filtered by the auteur_id column
 * @method array findByTags(string $tags) Return Article objects filtered by the tags column
 * @method array findByNbVue(int $nb_vue) Return Article objects filtered by the nb_vue column
 *
 * @package    propel.generator.semiolabs.om
 */
abstract class BaseArticleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseArticleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'semio', $modelName = 'Article', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ArticleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ArticleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ArticleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ArticleQuery) {
            return $criteria;
        }
        $query = new ArticleQuery();
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
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Article|Article[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ArticlePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ArticlePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Article A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Article A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `titre`, `texte`, `date`, `media`, `lien`, `type_id`, `auteur_id`, `tags`, `nb_vue` FROM `article` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Article();
            $obj->hydrate($row);
            ArticlePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Article|Article[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Article[]|mixed the list of results, formatted by the current formatter
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
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArticlePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArticlePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ArticlePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ArticlePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the titre column
     *
     * Example usage:
     * <code>
     * $query->filterByTitre('fooValue');   // WHERE titre = 'fooValue'
     * $query->filterByTitre('%fooValue%'); // WHERE titre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByTitre($titre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $titre)) {
                $titre = str_replace('*', '%', $titre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArticlePeer::TITRE, $titre, $comparison);
    }

    /**
     * Filter the query on the texte column
     *
     * Example usage:
     * <code>
     * $query->filterByTexte('fooValue');   // WHERE texte = 'fooValue'
     * $query->filterByTexte('%fooValue%'); // WHERE texte LIKE '%fooValue%'
     * </code>
     *
     * @param     string $texte The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByTexte($texte = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($texte)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $texte)) {
                $texte = str_replace('*', '%', $texte);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArticlePeer::TEXTE, $texte, $comparison);
    }

    /**
     * Filter the query on the date column
     *
     * Example usage:
     * <code>
     * $query->filterByDate('2011-03-14'); // WHERE date = '2011-03-14'
     * $query->filterByDate('now'); // WHERE date = '2011-03-14'
     * $query->filterByDate(array('max' => 'yesterday')); // WHERE date > '2011-03-13'
     * </code>
     *
     * @param     mixed $date The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByDate($date = null, $comparison = null)
    {
        if (is_array($date)) {
            $useMinMax = false;
            if (isset($date['min'])) {
                $this->addUsingAlias(ArticlePeer::DATE, $date['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($date['max'])) {
                $this->addUsingAlias(ArticlePeer::DATE, $date['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlePeer::DATE, $date, $comparison);
    }

    /**
     * Filter the query on the media column
     *
     * Example usage:
     * <code>
     * $query->filterByMedia('fooValue');   // WHERE media = 'fooValue'
     * $query->filterByMedia('%fooValue%'); // WHERE media LIKE '%fooValue%'
     * </code>
     *
     * @param     string $media The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByMedia($media = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($media)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $media)) {
                $media = str_replace('*', '%', $media);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArticlePeer::MEDIA, $media, $comparison);
    }

    /**
     * Filter the query on the lien column
     *
     * Example usage:
     * <code>
     * $query->filterByLien('fooValue');   // WHERE lien = 'fooValue'
     * $query->filterByLien('%fooValue%'); // WHERE lien LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lien The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByLien($lien = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lien)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lien)) {
                $lien = str_replace('*', '%', $lien);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArticlePeer::LIEN, $lien, $comparison);
    }

    /**
     * Filter the query on the type_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTypeId(1234); // WHERE type_id = 1234
     * $query->filterByTypeId(array(12, 34)); // WHERE type_id IN (12, 34)
     * $query->filterByTypeId(array('min' => 12)); // WHERE type_id >= 12
     * $query->filterByTypeId(array('max' => 12)); // WHERE type_id <= 12
     * </code>
     *
     * @see       filterByType()
     *
     * @param     mixed $typeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByTypeId($typeId = null, $comparison = null)
    {
        if (is_array($typeId)) {
            $useMinMax = false;
            if (isset($typeId['min'])) {
                $this->addUsingAlias(ArticlePeer::TYPE_ID, $typeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($typeId['max'])) {
                $this->addUsingAlias(ArticlePeer::TYPE_ID, $typeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlePeer::TYPE_ID, $typeId, $comparison);
    }

    /**
     * Filter the query on the auteur_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAuteurId(1234); // WHERE auteur_id = 1234
     * $query->filterByAuteurId(array(12, 34)); // WHERE auteur_id IN (12, 34)
     * $query->filterByAuteurId(array('min' => 12)); // WHERE auteur_id >= 12
     * $query->filterByAuteurId(array('max' => 12)); // WHERE auteur_id <= 12
     * </code>
     *
     * @see       filterByAuteur()
     *
     * @param     mixed $auteurId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByAuteurId($auteurId = null, $comparison = null)
    {
        if (is_array($auteurId)) {
            $useMinMax = false;
            if (isset($auteurId['min'])) {
                $this->addUsingAlias(ArticlePeer::AUTEUR_ID, $auteurId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($auteurId['max'])) {
                $this->addUsingAlias(ArticlePeer::AUTEUR_ID, $auteurId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlePeer::AUTEUR_ID, $auteurId, $comparison);
    }

    /**
     * Filter the query on the tags column
     *
     * Example usage:
     * <code>
     * $query->filterByTags('fooValue');   // WHERE tags = 'fooValue'
     * $query->filterByTags('%fooValue%'); // WHERE tags LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tags The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByTags($tags = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tags)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tags)) {
                $tags = str_replace('*', '%', $tags);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ArticlePeer::TAGS, $tags, $comparison);
    }

    /**
     * Filter the query on the nb_vue column
     *
     * Example usage:
     * <code>
     * $query->filterByNbVue(1234); // WHERE nb_vue = 1234
     * $query->filterByNbVue(array(12, 34)); // WHERE nb_vue IN (12, 34)
     * $query->filterByNbVue(array('min' => 12)); // WHERE nb_vue >= 12
     * $query->filterByNbVue(array('max' => 12)); // WHERE nb_vue <= 12
     * </code>
     *
     * @param     mixed $nbVue The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function filterByNbVue($nbVue = null, $comparison = null)
    {
        if (is_array($nbVue)) {
            $useMinMax = false;
            if (isset($nbVue['min'])) {
                $this->addUsingAlias(ArticlePeer::NB_VUE, $nbVue['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nbVue['max'])) {
                $this->addUsingAlias(ArticlePeer::NB_VUE, $nbVue['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticlePeer::NB_VUE, $nbVue, $comparison);
    }

    /**
     * Filter the query by a related Type object
     *
     * @param   Type|PropelObjectCollection $type The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ArticleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByType($type, $comparison = null)
    {
        if ($type instanceof Type) {
            return $this
                ->addUsingAlias(ArticlePeer::TYPE_ID, $type->getId(), $comparison);
        } elseif ($type instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticlePeer::TYPE_ID, $type->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByType() only accepts arguments of type Type or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Type relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function joinType($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Type');

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
            $this->addJoinObject($join, 'Type');
        }

        return $this;
    }

    /**
     * Use the Type relation Type object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TypeQuery A secondary query class using the current class as primary query
     */
    public function useTypeQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinType($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Type', 'TypeQuery');
    }

    /**
     * Filter the query by a related Auteur object
     *
     * @param   Auteur|PropelObjectCollection $auteur The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ArticleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAuteur($auteur, $comparison = null)
    {
        if ($auteur instanceof Auteur) {
            return $this
                ->addUsingAlias(ArticlePeer::AUTEUR_ID, $auteur->getId(), $comparison);
        } elseif ($auteur instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticlePeer::AUTEUR_ID, $auteur->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAuteur() only accepts arguments of type Auteur or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Auteur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function joinAuteur($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Auteur');

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
            $this->addJoinObject($join, 'Auteur');
        }

        return $this;
    }

    /**
     * Use the Auteur relation Auteur object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AuteurQuery A secondary query class using the current class as primary query
     */
    public function useAuteurQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAuteur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Auteur', 'AuteurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Article $article Object to remove from the list of results
     *
     * @return ArticleQuery The current query, for fluid interface
     */
    public function prune($article = null)
    {
        if ($article) {
            $this->addUsingAlias(ArticlePeer::ID, $article->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
