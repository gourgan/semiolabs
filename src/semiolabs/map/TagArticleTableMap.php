<?php



/**
 * This class defines the structure of the 'tag_article' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.semiolabs.map
 */
class TagArticleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'semiolabs.map.TagArticleTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('tag_article');
        $this->setPhpName('TagArticle');
        $this->setClassname('TagArticle');
        $this->setPackage('semiolabs');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id_article', 'IdArticle', 'INTEGER' , 'article', 'id', true, null, null);
        $this->addForeignPrimaryKey('id_tag', 'IdTag', 'INTEGER' , 'tag', 'id', true, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Tag', 'Tag', RelationMap::MANY_TO_ONE, array('id_tag' => 'id', ), 'CASCADE', null);
        $this->addRelation('Article', 'Article', RelationMap::MANY_TO_ONE, array('id_article' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // TagArticleTableMap
