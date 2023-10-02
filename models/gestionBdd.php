<?php
            function getConnection() {
                try {
                    $connexion = new PDO("mysql:host=localhost;dbname=lafleur;charset=utf8", 'utilfleur', 'secret');
                }
                catch(PDOException $e)
                    {
                    die($e->getMessage());
                    }
                return $connexion ;
            }

        function getCategories() {
             $connexion = getConnection();
             $stm = $connexion->query("SELECT cat_code, cat_libelle FROM categorie");
             $categories=$stm->fetchAll();
             return $categories ;
            }

            function getProduits($cat) {
                $connexion = getConnection();
                $stm = $connexion->prepare("SELECT pdt_ref, pdt_designation, pdt_prix, pdt_image
                                            FROM produit where pdt_categorie = :cat");
                $stm->bindParam(':cat', $cat, PDO::PARAM_INT);
                $stm->execute();
                $produits=$stm->fetchAll();
                return $produits ;

            }

            function getTousProduits() {
                $connexion = getConnection();
                $stm = $connexion->query("SELECT pdt_ref, pdt_designation, pdt_prix, pdt_image FROM produit");
                $produits=$stm->fetchAll();
                return $produits ;

            }
?>