<?php

use Silex\Provider\FormServiceProvider;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
$app = require __DIR__ . '/bootstrap.php';


// articles add; ;
$app->match('/gestion', function (Request $request) use ($app) {
					$app['session']->setFlash('success', null );
					$app['session']->setFlash('error', null );
					if (null == $app['session']->get('user')) {
						return $app->redirect($app['url_generator']->generate('admin'));
					}
                    $type_media = array();
                    $error = 0;
                    $types = TypeQuery::create()
                            ->find();
                    foreach ($types as $type) {
                        $type_media[$type->getId()] = $type->getLibelle();
                    }
                    $form = $app['form.factory']->createBuilder('form')
                            ->add('Type', 'choice', array(
                                'choices' => $type_media, 'attr' => array(
                                    'placeholder' => 'Texte...',
                                    'class' => 'input-block-level',
                                    'id' => 'type',
                                    'constraints' => array(
                                        new Assert\NotBlank(array('message' => 'Veuillez choisir un type'))
                                    )
                                )
                            ))
                            ->add('Titre', 'text', array(
                                'required' => true,
                                'constraints' => array(
                                    new Assert\NotBlank(array('message' => 'Veuillez saisir le titre de l\'article'))
                                ), 'attr' => array(
                                    'placeholder' => 'Titre de l\'article...',
                                    'class' => 'input-block-level'
                                )
                            ))
                            ->add('Texte', 'text', array(
                                'required' => true,
                                'constraints' => array(
                                    new Assert\NotBlank(array('message' => 'Veuillez saisir le contenu de l\'article'))
                                ), 'attr' => array(
                                    'placeholder' => 'Texte...',
                                    'class' => ' rte-zone input-block-level'
                                    ))
                            )
                            ->add('Tags', 'text', array(
                                'required' => true,
                                'constraints' => array(
                                ), 'attr' => array(
                                    'placeholder' => 'Tags...',
                                    'class' => 'input-block-level'
                                )
                            ))
                            ->add('date-publication', 'text', array(
                                'required' => false,
                                'constraints' => array(
                                ), 'attr' => array(
                                    'class'=>'datepicker',
                                    
                                )
                            ))
                            ->add('Lien', 'url', array(
                                'required' => false,
                                'constraints' => array(
                                ), 'attr' => array(
                                    'placeholder' => 'Lien media...',
                                    'class' => 'input-block-level',
                                    'id' => 'lien'
                                )
                            ))
                            ->add('MediaOther', 'text', array(
                                'required' => false,
                                'constraints' => array(
                                ), 'attr' => array(
                                    'placeholder' => 'l\'id de la video (exemple : < hYnqTNntGxU >)',
                                    'class' => 'input-block-level',
                                    'id' => 'mediao'
                                )
                            ))
                            ->add('Media', 'file', array(
                                'label' => 'Votre image ',
                                'required' => false,
                                'constraints' => array(
                                ),
                                'attr' => array(
                                    'help' => 'pas de spam !',
                                    'class' => 'fileupload fileupload-new',
                                    'style' => '',
                                    'id' => 'media'
                                )
                            ))
                            ->getForm();

                    if ('POST' == $request->getMethod()) {
                        $form->bind($request);
                        $data = $form->getData();

                        if ($form->isValid()) {

                            $article = new Article();
                            $type = $data['Type'];
                            $article->setTitre($data['Titre']);
                            $article->setTexte($data['Texte']);
                            if($data["date-publication"]==""){
                                $article->setDate(new DateTime());
                            }else{
                                $article->setDate($data["date-publication"]);
                            }
                            
                            $article->setLien($data['Lien']);

                            //if image exist
                            $files = $form['Media']->getData();
                            if (!empty($files)) {

                                $file = $form['Media']->getData();
                                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                                $dir = '../web/uploads/';
                                $MediaName = '/semiolabs/web/uploads/' . rand(1, 99999) . '.' . $extension;
                                //check the extension (we just accept mp3);
                                if ($extension == "jpg" || $extension == "png" || $extension == "gif") {
                                    //if the file was succesfully uploaded

                                    if ($file->move($dir, $MediaName)) {
                                       $error = 0;
                                    } else {
                                        $error = 1;
                                    }
                                } else {
                                    $error = 1;
                                }
                            } elseif (!empty($data['MediaOther'])) {
                                $MediaName = $data['MediaOther'];
                            }
                            $article->setMedia($MediaName);
                            $article->setTypeId($type);
                            $article->setTags($data['Tags']);
                            if ($error != 1) {
                                $article->save();
								$app['session']->setFlash('success', 'Votre Article est ajout&eacute; avec succ&eacute;s');
                            } else {
                                $app['session']->setFlash('error', 'Erreur  existantes dans la page');
                            }
                        }
                    }
                    return $app['twig']->render('/../views/template/gestion.twig', array(
                                'form' => $form->createView(),
                                'page' => 'gestion',
                     )
                    );
                })
        ->bind('gestion');

//shows admin login;               
$app->match('/admin', function (Request $request) use ($app) {
					$app['session']->setFlash('success', null);
					$app['session']->setFlash('error', null);

                    $form = $app['form.factory']->createBuilder('form')
                            ->add('Login', 'text', array(
                                'attr' => array(
                                    'placeholder' => 'Login...',
                                    'class' => 'input-block-level',
                                    'constraints' => array(
                                        new Assert\NotBlank(array('message' => 'Veuillez entrer un login '))
                                    )
                                )
                            ))
                            ->add('Password', 'password', array(
                                'required' => true,
                                'constraints' => array(
                                    new Assert\NotBlank(array('message' => 'Veuillez entrer un mot de passe'))
                                ), 'attr' => array(
                                    'class' => 'input-block-level'
                                )
                            ))
                            ->getForm();

                    if ('POST' == $request->getMethod()) {
                        $form->bind($request);
                        $data = $form->getData();

                        $auteur = AuteurQuery::create()
                                ->filterByLogin($data['Login'])
                                ->filterByPassword($data['Password'])
                                ->find();
                        if ($form->isValid()) {
                            if (count($auteur)!=0) {
								$app['session']->set('user', array('username' => $data['Login']));
                                return $app->redirect($app['url_generator']->generate('gestion'));
                            } else {
                                $app['session']->setFlash('error', 'login ou mot de passe');
                            }
                        }
                    }
                    return $app['twig']->render('/../views/template/admin.twig', array(
                                'form' => $form->createView(),
                                'page' => 'admin',
                                    )
                    );
                })
        ->bind('admin');



//modify articles           
$app->match('/articles/modify/{item}', function (Request $request, $item) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);       
			if (null == $app['session']->get('user')) {
				return $app->redirect($app['url_generator']->generate('admin'));
			}
			$article = ArticleQuery::create()
                    ->findOneById($item);
            $type_media = array();
            $types = TypeQuery::create()
                    ->find();

            foreach ($types as $type) {
                $type_media[$type->getId()] = $type->getLibelle();
            }

            $form = $app['form.factory']->createBuilder('form')
                    ->add('Type', 'choice', array(
                        'choices' => $type_media,
                        'preferred_choices' => array($article->getType()->getId()),
                        'attr' => array(
                            'placeholder' => 'Texte...',
                            'class' => 'input-block-level',
                            'id' => 'type',
                        )
                    ))
                    ->add('Titre', 'text', array(
                        'required' => true,
                        'constraints' => array(
                            new Assert\NotBlank(array('message' => 'Veuillez saisir le titre de l\'article'))
                        ), 'attr' => array(
                            'placeholder' => 'Titre de l\'article...',
                            'class' => 'input-block-level',
                            'value' => $article->getTitre()
                        )
                    ))
                    ->add('Texte', 'text', array(
                        'required' => true,
                        'constraints' => array(
                            new Assert\NotBlank(array('message' => 'Veuillez saisir le contenu de l\'article'))
                        ), 'attr' => array(
                            'placeholder' => 'Texte...',
                            'class' => 'rte-zone input-block-level',
                            'value' => $article->getTexte()
                        )
                    ))
                    ->add('Tags', 'text', array(
                        'required' => true,
                        'constraints' => array(
                        ), 'attr' => array(
                            'placeholder' => 'Tags...',
                            'class' => 'input-block-level',
                            'value' => $article->getTags()
                        )
                    ))
                    ->add('Lien', 'url', array(
                        'required' => false,
                        'constraints' => array(
                        ), 'attr' => array(
                            'placeholder' => 'Lien media...',
                            'class' => 'input-block-level',
                            'id' => 'lien',
                            'value' => $article->getLien()
                        )
                    ))
                    ->add('MediaOther', 'text', array(
                        'required' => false,
                        'constraints' => array(
                        ), 'attr' => array(
                            'placeholder' => 'l\'id de la video (exemple : < hYnqTNntGxU >)',
                            'class' => 'input-block-level',
                            'id' => 'mediao'
                        )
                    ))
                    ->add('Media', 'file', array(
                        'label' => 'Votre image ',
                        'required' => false,
                        'constraints' => array(
                        ),
                        'attr' => array(
                            'help' => 'pas de spam !',
                            'class' => 'fileupload fileupload-new',
                            'style' => '',
                            'id' => 'media'
                        )
                    ))
                    ->getForm();

            if ('POST' == $request->getMethod()) {
                $form->bind($request);
                $data = $form->getData();

                if ($form->isValid()) {

                    $article2 = ArticleQuery::create()
                            ->findOneById($item);

                    $type = $data['Type'];
                    $article2->setTitre($data['Titre']);
                    $article2->setTexte($data['Texte']);
                    $article2->setDate(new DateTime());
                    $article2->setLien($data['Lien']);

                    //if image exist
                    $files = $form['Media']->getData();
                    if (!empty($files)) {

                        $file = $form['Media']->getData();
                        $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                        $dir = '../web/uploads/';
                        $MediaName = '/semiolabs/web/uploads/' . rand(1, 99999) . '.' . $extension;
                        //check the extension (we just accept mp3);
                        if ($extension == "jpg" || $extension == "png" || $extension == "gif") {
                            //if the file was succesfully uploaded

                            if ($file->move($dir, $MediaName)) {
                                $app['session']->setFlash('success', 'Votre Article est ajout&eacute; avec succ&eacute;s');
                            } else {
                                $error = 1;
                            }
                        } else {
                            $error = 1;
                        }
                    } elseif (!empty($data['MediaOther'])) {
                        $MediaName = $data['MediaOther'];
                    }
                    $article2->setMedia($MediaName);
                    $article2->setTypeId($type);
                    $article2->setTags($data['Tags']);
                    if ($error != 1) {
                        $article2->save();
                    } else {
                        $app['session']->setFlash('error', 'Erreur  existantes dans la page');
                    }
                    return $app->redirect($app['url_generator']->generate('gestion'));
                }
            }
            return $app['twig']->render('/../views/template/modify.twig', array(
                        'form' => $form->createView(),
                        'page' => 'modify',
                        'article' => $article
                            )
            );
        });



//shows article details
$app->get('/article/{item}', function ($item) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           

                    try {

                        //Find the article to show 
                        $article = ArticleQuery::create()
                                ->findOneById($item);
                        //find tags 
                        $tags = ArticleQuery::create()
                                ->setDistinct("tags")
                                ->orderByDate('DESC')
                                ->setLimit('2')
                                ->find();


                        return $app['twig']->render('/../views/template/article.twig', array(
                                    'page' => 'article',
                                    'article' => $article,
                                    'tags' => $tags
                                ));



                        return $app->redirect($app['url_generator']->generate('article'));
                    } catch (Exception $e) {
                        if ("Twig_Error_Loader" == get_class($e)) {
                            return $app['twig']->render('/../views/template/error.twig');
                        } else {
                            throw $e;
                        }
                    }
                })
        ->bind('article');


//page webench that contain articles with photo types

$app->get('/webench', function (Request $request) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           

                    try {

                        //Find pictures to show in webench
                        $article = ArticleQuery::create()
                                ->filterByTypeId('3')
                                ->find();

                        return $app['twig']->render('/../views/template/webench.twig', array(
                                    'page' => 'webench',
                                    'articles' => $article,
                                ));
                    } catch (Exception $e) {
                        if ("Twig_Error_Loader" == get_class($e)) {
                            return $app['twig']->render('/../views/template/error.twig');
                        } else {
                            throw $e;
                        }
                    }
                })
        ->bind('webench');

//shows search result;

$app->match('/searching', function (Request $request) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           
                       
                    $toSearch = $_POST['tags'];
                    if ('POST' == $request->getMethod()) {
                        $article_tags = ArticleQuery::create()
                                ->filterByTags('%' . $toSearch . '%')
                                ->orderByDate('DESC')
                                ->setLimit('3')
                                ->find();
                        $tags = ArticleQuery::create()
                                ->setDistinct("tags")
                                ->setLimit('10')
                                ->find();
                        $nb_result = count($article_tags);

                        if ($nb_result > 0)
                            $app['session']->setFlash('success', '(' . $nb_result . ') article(s) trouv&eacute;e(s)');
                        else
                            $app['session']->setFlash('error', 'Aucune article trouv&eacute;e!!');
                    }

                    return $app['twig']->render('/../views/template/search.twig', array(
                                'page' => 'searching',
                                'articles' => $article_tags,
                                'searched' => $toSearch,
                                'tags' => $tags
                                    )
                    );
                })
->bind('searching');
              
///search with tags from home 
$app->match('/search/{item}', function (Request $request,$item) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           
                    
                        $article_tags = ArticleQuery::create()
                                ->filterByTags('%' . $item . '%')
                                ->orderByDate('DESC')
                                ->setLimit('3')
                                ->find();
                        $tags = ArticleQuery::create()
                                ->setDistinct("tags")
                                ->setLimit('10')
                                ->find();
                        $nb_result = count($article_tags);

                        if ($nb_result > 0)
                            $app['session']->setFlash('success', '(' . $nb_result . ') article(s) trouv&eacute;e(s)');
                        else
                            $app['session']->setFlash('error', 'Aucune article trouv&eacute;e!!');
                    

                    return $app['twig']->render('/../views/template/search.twig', array(
                                'page' => 'search',
                                'articles' => $article_tags,
                                'searched' => $item,
                                'tags' => $tags
                                    )
                    );
                })
->bind('search');   
              
                

$app->match('/contact', function (Request $request) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           
					
					
			 if ('POST' == $request->getMethod()) {
				$data = $_POST;
				$nom=$data['nom'];
				$prenom=$data['prenom'];
				$email=$data['email'];
				$sujet=$data['sujet'];
				$body='Bonjour,<br/> Vous avez recu un message sur votre page contact | SemioLabs | <br/><b>Le contenu du message : </b><br/><br/> <b>{</b> <br/>  '.$data['message'].'<br/><b>   }</b> <br/> <br/><img src="http://etudima.com/semiolabs/web/images/logo.jpg" alt="semiolabs" />';

				require_once __DIR__ . '/../vendor/swiftmailer/swiftmailer/lib/swift_required.php';
				if(\Swift_Mailer::newInstance(\Swift_MailTransport::newInstance())
					->send(\Swift_Message::newInstance()
						->setContentType('text/html')
						->setSubject(sprintf('[Semiolabs] Contact de :: %s', $nom.' '.$prenom))
						->setFrom(array($email))
						->setTo(array('gourgan.hicham@gmail.com'))
						->setBody($body)
					))
					{
						$app['session']->setFlash('success', 'Votre message &agrave; &eacute;t&eacute; bien envoy&eacute;e ');
					}
					else
					{
                        $app['session']->setFlash('error', 'Il existe des erreur lors de l\'envoie de votre message');						
					}
         
            }
			return $app['twig']->render('/../views/template/contact.twig', array(
                                'page' => 'contact',

				)
			);
})
->bind('contact');

//charge result for search and home ;
$app->match('/ajax', function (Request $request) use ($app) {
 			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           

					$nb = $_POST['nmb'];
                    //test if rendered page is search or home;                                
                    if (isset($_POST['tags']) && $_POST['tags'] != "") {
                        $toSearch = $_POST['tags'];
                        $con = Propel::getConnection("semio");
                        $sql = ("SELECT  * FROM article WHERE tags LIKE '%" . $toSearch . "%' ORDER BY date DESC LIMIT $nb,3 ");
                        $stmt = $con->prepare($sql);
                        $stmt->execute();
                        $articles_tags = ArticlePeer::populateObjects($stmt);
                    } else {
                        $articles_tags = ArticleQuery::create()
                                ->orderByDate('DESC')
                                ->setLimit("$nb,3")
                                ->find();
                        $toSearch = "";
                    }

                    $nb_result = count($articles_tags);
                    if ($nb_result > 0)
                        $app['session']->setFlash('success', '(' . $nb_result . ') article(s) trouv&eacute;e(s)');
                    else
                        $app['session']->setFlash('error', 'Aucune article trouv&eacute;e!!');


                    return $app['twig']->render('/../views/template/ajaxArticle.twig', array(
                                'page' => 'ajaxArticle',
                                'articles' => $articles_tags,
                                'searched' => $toSearch
                                    )
                    );
                })
        ->bind('ajax');

//return article Lists
$app->match('/liste', function (Request $request) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           
			 if (null == $app['session']->get('user')) {
				return $app->redirect($app['url_generator']->generate('admin'));
			}
                    $articleResult = ArticleQuery::create()
									->orderByDate('DESC')
									->find();

                    $nb_result = count($articleResult);

                    if ($nb_result > 0)
                        $app['session']->setFlash('success', '(' . $nb_result . ') article(s) trouv&eacute;e(s)');
                    else
                        $app['session']->setFlash('error', 'Aucune article trouv&eacute;e!!');


                    return $app['twig']->render('/../views/template/liste.twig', array(
                                'page' => 'liste',
                                'articleResult' => $articleResult
                                    )
                    );
                })
->bind('liste');



//other pages code
$app->get('/articles/{action}/{item}', function ($action, $item) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           
			if (null == $app['session']->get('user')) {
				return $app->redirect($app['url_generator']->generate('admin'));
			}
            try {
                //$uploadDirectory = $app['url_generator']->generate('cms') . 'uploads/';
                if ($action == 'remove') {

                    //if Add action was declenched to add music to playlist
                    $articles = ArticleQuery::create()
                            ->findOneById($item)
                            ->delete();

                    return $app->redirect($app['url_generator']->generate('liste'));
                }
            } catch (Exception $e) {
                if ("Twig_Error_Loader" == get_class($e)) {
                    return $app['twig']->render('/../views/template/error.twig');
                } else {
                    throw $e;
                }
            }
});

//logout page
$app->get('/logout', function () use ($app) {
			
            try {
					//delete the session user
				    $app['session']->set('user', null);
                    return $app->redirect($app['url_generator']->generate('admin'));
                
            } catch (Exception $e) {
                if ("Twig_Error_Loader" == get_class($e)) {
                    return $app['twig']->render('/../views/template/error.twig');
                } else {
                    throw $e;
                }
            }
})
->bind('logout');

//show home page and others to add after;
$app->get('/{name}', function ($name) use ($app) {
			$app['session']->setFlash('success', null);
			$app['session']->setFlash('error', null);           

                    try {
                       
                        $articles = ArticleQuery::create()
                                ->filterByDate(new DateTime(), '<=')
                                ->orderByDate('DESC')
                                ->setLimit('3')
                                ->find();
                        $tags = ArticleQuery::create()
                                ->setDistinct("tags")
                                ->setLimit('10')
                                ->find();

                        return $app['twig']->render('/../views/template/' . $name . '.twig', array(
                                    'page' => $name,
                                    'articles' => $articles,
                                    'tags' => $tags
                                ));
                    } catch (Exception $e) {
                        if ("Twig_Error_Loader" == get_class($e)) {
                            return $app['twig']->render('/../views/template/error.twig');
                        } else {
                            throw $e;
                        }
                    }
                })
        ->value('name', 'home')
        ->bind('cms');

return $app;
