<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Content\Controller\Index' => 'Content\Controller\IndexController',
            'Content\Controller\Article' => 'Content\Controller\ArticleController',
            'Content\Controller\Rubrique' => 'Content\Controller\RubriqueController',
        ),
    ),
    'router' => array(
        'routes' => array(
        	//////////////////////////chemin vers le home
        	//http://cms
        	'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Content\Controller',
                        'controller' => 'Rubrique',
                        'action'     => 'list',
                    ),
                ),
            ),
            //////////////////////////chemin vers liste rubriques ki est le meme ke route::home
            //http://cms/rubriques
        	'rubriques' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/rubriques',
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Content\Controller',
                        'controller' => 'Rubrique',
                        'action'     => 'list',
                    ),
                ),
            ),
            //////////////////////////chemin vers liste tous les articles de toutes les rubriques
            //http://cms/articles
            'articles' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/articles',
                    'defaults' => array(
                    	'__NAMESPACE__' => 'Content\Controller',
                        'controller' => 'Article',
                        'action'     => 'list',
                    ),
                ),
            ),
            //////////////////////////chemin vers liste tous les articles d'une rubrique
            //http://cms/rubrique/id
            'rubrique' => array(
                'type'    => 'Segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/rubrique/:id_rubrique',
                    'constraints' => array(
                    	'id_rubrique' => '[0-9]*'
                    ),
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Content\Controller',
                        'controller'    => 'Article',
                        'action'        => 'list',
                    ),
                ),
                //////////////////////////chemin vers view article
            	//http://cms/article/idx/article/idy
                'may_terminate' => true,
                'child_routes' => array(
                    'article' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/article/:id_article',
                            'constraints' => array(
                                'id_article' => '[0-9]*'
                            ),
                            'defaults' => array(
                            	'__NAMESPACE__' => 'Content\Controller',
                        		'controller'    => 'Article',
                        		'action'        => 'view',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Content' => __DIR__ . '/../view',
        ),
    ),
);
