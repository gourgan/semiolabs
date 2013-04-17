<?php



/**
 * This class defines the structure of the 'article' table.
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
class ArticleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'semiolabs.map.ArticleTableMap';

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
        $this->setName('article');
        $this->setPhpName('Article');
        $this->setClassname('Article');
        $this->setPackage('semiolabs');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('titre', 'Titre', 'VARCHAR', false, 255, null);
        $this->addColumn('texte', 'Texte', 'VARCHAR', false, 255, null);
        $this->addColumn('date', 'Date', 'DATE', false, null, null);
        $this->addColumn('media', 'Media', 'VARCHAR', false, 255, null);
        $this->addColumn('lien', 'Lien', 'VARCHAR', false, 255, null);
        $this->addForeignKey('type_id', 'TypeId', 'INTEGER', 'type', 'id', false, null, null);
        $this->addForeignKey('auteur_id', 'AuteurId', 'INTEGER', 'auteur', 'id', false, null, null);
        $this->addColumn('tags', 'Tags', 'VARCHAR', false, 255, null);
        $this->addColumn('nb_vue', 'NbVue', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Type', 'Type', RelationMap::MANY_TO_ONE, array('type_id' => 'id', ), 'CASCADE', null);
        $this->addRelation('Auteur', 'Auteur', RelationMap::MANY_TO_ONE, array('auteur_id' => 'id', ), 'CASCADE', null);
    } // buildRelations()

} // ArticleTableMap
