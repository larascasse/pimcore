<?php 

/** 
* Generated at: 2019-07-15T11:16:48+02:00
* Inheritance: yes
* Variants: no
* Changed by: florent (6)
* IP: 172.31.29.60


Fields Summary: 
- actif_web [checkbox]
- obsolete [checkbox]
- echantillon [checkbox]
- pimonly_print_label [input]
- pimonly_equivalence_auto [input]
- pimonly_equivalence [input]
- code [input]
- ean [input]
- plusValue [href]
- name_scienergie [input]
- name_scienergie_court [input]
- catalogue [select]
- product_type [select]
- subtype [input]
- subtype2 [input]
- pimonly_teinte_rel [objects]
- teinte_type [select]
- name_scienergie_converti [input]
- name_scienergie2 [input]
- name [input]
- short_name [input]
- pimonly_name_suffixe [input]
- pimonly_dimensions [input]
- short_description [textarea]
- short_description_title [input]
- description [textarea]
- pimonly_sub_description_prefixe [textarea]
- pimonly_sub_description [textarea]
- extra_content1 [wysiwyg]
- lesplus [textarea]
- remarque [textarea]
- no_stock_delay [input]
- leadtime [input]
- shipping_type [select]
- mage_qty_description [textarea]
- mage_custom_option [textarea]
- image_1 [image]
- image_2 [image]
- image_3 [image]
- image_4 [image]
- image_texture [image]
- gallery [multihref]
- chauffantBasseTemperature [select]
- pimonly_chauffantBasseTemperature [calculatedValue]
- chauffantRadiantElectrique [select]
- pimonly_chauffantRadiantElectrique [calculatedValue]
- solRaffraichissant [select]
- pimonly_solRaffraichissant [calculatedValue]
- chauffantAccumulationBasseTemperature [select]
- essence [input]
- support [select]
- epaisseurUsure [input]
- norme_sanitaire [select]
- classe [input]
- classe_utilisation [calculatedValue]
- pimonly_classe_utilisation [input]
- classe_upec [calculatedValue]
- pimonly_classe_upec [input]
- masse_volumique [calculatedValue]
- pimonly_masse_volumique_moyenne [input]
- classe_reaction_feu_eu [calculatedValue]
- pimonly_classe_reaction_feu_eu [textarea]
- classe_reaction_feu_fr [calculatedValue]
- pimonly_classe_reaction_feu_fr [textarea]
- degagement_formaldehyde [calculatedValue]
- resistance_thermique [calculatedValue]
- pimonly_resistance_thermique [input]
- conductivite_thermique_total [calculatedValue]
- pimonly_conductivite_thermique_total [input]
- condition_mise_en_oeuvre [calculatedValue]
- taux_humidite [input]
- coefficient_retractabilite [calculatedValue]
- durabilite_ecologique [calculatedValue]
- largeurString [input]
- longueurString [input]
- epaisseurString [input]
- choixString [input]
- traitement_surfaceString [input]
- motifString [input]
- finitionString [input]
- choix [input]
- choix_not_configurable [checkbox]
- traitement_surface [select]
- traitement_surface_not_configurable [checkbox]
- finition [select]
- finition_not_configurable [checkbox]
- motif [select]
- fixation [multiselect]
- fixation_not_configurable [checkbox]
- pose [multiselect]
- epaisseur [input]
- epaisseur_txt [input]
- epaisseur_not_configurable [checkbox]
- largeur [input]
- largeur_txt [input]
- largeur_type [select]
- largeur_colis [input]
- largeur_not_configurable [checkbox]
- longueur [input]
- longueur_txt [input]
- longueur_min [input]
- longueur_max [input]
- longueur_colis [input]
- longueur_not_configurable [checkbox]
- mage_section [input]
- pimonly_section [input]
- mage_use_section_as_configurable [checkbox]
- hauteur [input]
- hauteur_colis [input]
- hauteur_not_configurable [checkbox]
- color [select]
- color_not_configurable [checkbox]
- volume [input]
- volume_not_configurable [checkbox]
- conditionnement [input]
- conditionnement_not_configurable [checkbox]
- chanfreins [input]
- mage_use_chanfreins_as_configurable [checkbox]
- profil [multiselect]
- profil_not_configurable [checkbox]
- configurable_free_1 [input]
- configurable_free_2 [input]
- quantity_min [input]
- quantity_max [input]
- quantity_min_txt [input]
- quantity_min_txt_not_configurable [checkbox]
- characteristics_others [textarea]
- characteristics_others_tech [textarea]
- characteristics_others_perf [textarea]
- unite [input]
- weight [input]
- mode_calcul [input]
- rendement [input]
- famille [input]
- classe_service [input]
- origine_bois [input]
- country_of_manufacture [input]
- colisage [input]
- surface [input]
- typeLame [select]
- angle [input]
- is_lot [select]
- pieceHumide [select]
- sousCoucheIntegree [checkbox]
- pefc [checkbox]
- fsc [checkbox]
- parquet_de_france [checkbox]
- nf [checkbox]
- nbrpp [input]
- qualite [input]
- extras [objects]
- realisations [multihref]
- fiche_technique_lpn [href]
- fiche_technique_orginale [href]
- notice_pose_lpn [href]
- fiche_securite [href]
- fiche_entretien [href]
- fiche_pose [href]
- re_skus [objects]
- cs_skus [objects]
- pimonly_category_pose [href]
- pimonly_category_finition [href]
- pimonly_category_entretien [href]
- associatedArticles [objects]
- origineArticles [objects]
- Categories [nonownerobjects]
- meta_title [input]
- meta_title2 [input]
- meta_description [input]
- meta_keywords [input]
- price [input]
- price_1 [input]
- price_2 [input]
- price_3 [input]
- price_4 [input]
- mage_visibility [select]
- accessoirepopin [objects]
- mage_accessoirepopin [input]
- mage_name [textarea]
- mage_short_name [textarea]
- mage_meta_title [input]
- mage_teinte [input]
- mage_teinte_level0 [input]
- mage_teinte_level1 [input]
- mage_teinte_level2 [input]
- mage_meta_description [textarea]
- mage_lesplus [textarea]
- mage_description [textarea]
- mage_sub_description [textarea]
- characteristics [textarea]
- mage_guideline [textarea]
- mage_associated_articles [textarea]
- image_1_src [input]
- image_2_src [input]
- image_3_src [input]
- mage_mediagallery [input]
- mage_fichepdf [input]
- mage_notice_pose_lpn [input]
- mage_invoice_description [textarea]
- mage_realisations [textarea]
- mage_realisationsJson [textarea]
- mage_config_description [textarea]
- mage_re_skus [input]
- mage_produitspose [input]
- mage_produitsfinition [input]
- mage_produitsentretien [input]
- mage_cs_skus [input]
- mage_origine_arbre [textarea]
- configurableFields [input]
- childrenSimpleProductIds_flat [input]
- teinte_lpn [select]
- mage_tags [input]
*/ 

namespace Pimcore\Model\Object;



/**
* @method \Pimcore\Model\Object\Product\Listing getByActif_web ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByObsolete ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEchantillon ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_print_label ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_equivalence_auto ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_equivalence ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCode ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEan ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPlusValue ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByName_scienergie ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByName_scienergie_court ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCatalogue ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByProduct_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySubtype ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySubtype2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_teinte_rel ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTeinte_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByName_scienergie_converti ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByName_scienergie2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByName ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByShort_name ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_name_suffixe ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_dimensions ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByShort_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByShort_description_title ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByDescription ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_sub_description_prefixe ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_sub_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByExtra_content1 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLesplus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByRemarque ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByNo_stock_delay ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLeadtime ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByShipping_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_qty_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_custom_option ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_1 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_3 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_4 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_texture ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByGallery ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChauffantBasseTemperature ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_chauffantBasseTemperature ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChauffantRadiantElectrique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_chauffantRadiantElectrique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySolRaffraichissant ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_solRaffraichissant ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChauffantAccumulationBasseTemperature ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEssence ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySupport ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEpaisseurUsure ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByNorme_sanitaire ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse_utilisation ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_classe_utilisation ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse_upec ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_classe_upec ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMasse_volumique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_masse_volumique_moyenne ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse_reaction_feu_eu ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_classe_reaction_feu_eu ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse_reaction_feu_fr ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_classe_reaction_feu_fr ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByDegagement_formaldehyde ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByResistance_thermique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_resistance_thermique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConductivite_thermique_total ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_conductivite_thermique_total ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCondition_mise_en_oeuvre ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTaux_humidite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCoefficient_retractabilite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByDurabilite_ecologique ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeurString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueurString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEpaisseurString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChoixString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTraitement_surfaceString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMotifString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFinitionString ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChoix ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChoix_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTraitement_surface ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTraitement_surface_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFinition ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFinition_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMotif ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFixation ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFixation_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPose ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEpaisseur ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEpaisseur_txt ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByEpaisseur_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeur ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeur_txt ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeur_type ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeur_colis ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLargeur_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur_txt ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur_min ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur_max ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur_colis ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByLongueur_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_section ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_section ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_use_section_as_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByHauteur ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByHauteur_colis ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByHauteur_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByColor ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByColor_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByVolume ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByVolume_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConditionnement ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConditionnement_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChanfreins ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_use_chanfreins_as_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByProfil ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByProfil_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConfigurable_free_1 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConfigurable_free_2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByQuantity_min ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByQuantity_max ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByQuantity_min_txt ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByQuantity_min_txt_not_configurable ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCharacteristics_others ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCharacteristics_others_tech ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCharacteristics_others_perf ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByUnite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByWeight ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMode_calcul ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByRendement ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFamille ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByClasse_service ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByOrigine_bois ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCountry_of_manufacture ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByColisage ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySurface ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTypeLame ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByAngle ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByIs_lot ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPieceHumide ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getBySousCoucheIntegree ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPefc ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFsc ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByParquet_de_france ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByNf ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByNbrpp ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByQualite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByExtras ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByRealisations ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFiche_technique_lpn ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFiche_technique_orginale ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByNotice_pose_lpn ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFiche_securite ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFiche_entretien ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByFiche_pose ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByRe_skus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCs_skus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_category_pose ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_category_finition ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPimonly_category_entretien ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByAssociatedArticles ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByOrigineArticles ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMeta_title ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMeta_title2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMeta_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMeta_keywords ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice_1 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice_2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice_3 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByPrice_4 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_visibility ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByAccessoirepopin ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_accessoirepopin ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_name ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_short_name ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_meta_title ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_teinte ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_teinte_level0 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_teinte_level1 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_teinte_level2 ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_meta_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_lesplus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_sub_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByCharacteristics ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_guideline ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_associated_articles ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_1_src ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_2_src ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByImage_3_src ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_mediagallery ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_fichepdf ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_notice_pose_lpn ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_invoice_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_realisations ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_realisationsJson ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_config_description ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_re_skus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_produitspose ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_produitsfinition ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_produitsentretien ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_cs_skus ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_origine_arbre ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByConfigurableFields ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByChildrenSimpleProductIds_flat ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByTeinte_lpn ($value, $limit = 0) 
* @method \Pimcore\Model\Object\Product\Listing getByMage_tags ($value, $limit = 0) 
*/

class Product extends Concrete {

public $o_classId = 5;
public $o_className = "product";
public $actif_web;
public $obsolete;
public $echantillon;
public $pimonly_print_label;
public $pimonly_equivalence_auto;
public $pimonly_equivalence;
public $code;
public $ean;
public $plusValue;
public $name_scienergie;
public $name_scienergie_court;
public $catalogue;
public $product_type;
public $subtype;
public $subtype2;
public $pimonly_teinte_rel;
public $teinte_type;
public $name_scienergie_converti;
public $name_scienergie2;
public $name;
public $short_name;
public $pimonly_name_suffixe;
public $pimonly_dimensions;
public $short_description;
public $short_description_title;
public $description;
public $pimonly_sub_description_prefixe;
public $pimonly_sub_description;
public $extra_content1;
public $lesplus;
public $remarque;
public $no_stock_delay;
public $leadtime;
public $shipping_type;
public $mage_qty_description;
public $mage_custom_option;
public $image_1;
public $image_2;
public $image_3;
public $image_4;
public $image_texture;
public $gallery;
public $chauffantBasseTemperature;
public $chauffantRadiantElectrique;
public $solRaffraichissant;
public $chauffantAccumulationBasseTemperature;
public $essence;
public $support;
public $epaisseurUsure;
public $norme_sanitaire;
public $classe;
public $pimonly_classe_utilisation;
public $pimonly_classe_upec;
public $pimonly_masse_volumique_moyenne;
public $pimonly_classe_reaction_feu_eu;
public $pimonly_classe_reaction_feu_fr;
public $pimonly_resistance_thermique;
public $pimonly_conductivite_thermique_total;
public $taux_humidite;
public $largeurString;
public $longueurString;
public $epaisseurString;
public $choixString;
public $traitement_surfaceString;
public $motifString;
public $finitionString;
public $choix;
public $choix_not_configurable;
public $traitement_surface;
public $traitement_surface_not_configurable;
public $finition;
public $finition_not_configurable;
public $motif;
public $fixation;
public $fixation_not_configurable;
public $pose;
public $epaisseur;
public $epaisseur_txt;
public $epaisseur_not_configurable;
public $largeur;
public $largeur_txt;
public $largeur_type;
public $largeur_colis;
public $largeur_not_configurable;
public $longueur;
public $longueur_txt;
public $longueur_min;
public $longueur_max;
public $longueur_colis;
public $longueur_not_configurable;
public $mage_section;
public $pimonly_section;
public $mage_use_section_as_configurable;
public $hauteur;
public $hauteur_colis;
public $hauteur_not_configurable;
public $color;
public $color_not_configurable;
public $volume;
public $volume_not_configurable;
public $conditionnement;
public $conditionnement_not_configurable;
public $chanfreins;
public $mage_use_chanfreins_as_configurable;
public $profil;
public $profil_not_configurable;
public $configurable_free_1;
public $configurable_free_2;
public $quantity_min;
public $quantity_max;
public $quantity_min_txt;
public $quantity_min_txt_not_configurable;
public $characteristics_others;
public $characteristics_others_tech;
public $characteristics_others_perf;
public $unite;
public $weight;
public $mode_calcul;
public $rendement;
public $famille;
public $classe_service;
public $origine_bois;
public $country_of_manufacture;
public $colisage;
public $surface;
public $typeLame;
public $angle;
public $is_lot;
public $pieceHumide;
public $sousCoucheIntegree;
public $pefc;
public $fsc;
public $parquet_de_france;
public $nf;
public $nbrpp;
public $qualite;
public $extras;
public $realisations;
public $fiche_technique_lpn;
public $fiche_technique_orginale;
public $notice_pose_lpn;
public $fiche_securite;
public $fiche_entretien;
public $fiche_pose;
public $re_skus;
public $cs_skus;
public $pimonly_category_pose;
public $pimonly_category_finition;
public $pimonly_category_entretien;
public $associatedArticles;
public $origineArticles;
public $meta_title;
public $meta_title2;
public $meta_description;
public $meta_keywords;
public $price;
public $price_1;
public $price_2;
public $price_3;
public $price_4;
public $mage_visibility;
public $accessoirepopin;
public $mage_accessoirepopin;
public $mage_name;
public $mage_short_name;
public $mage_meta_title;
public $mage_teinte;
public $mage_teinte_level0;
public $mage_teinte_level1;
public $mage_teinte_level2;
public $mage_meta_description;
public $mage_lesplus;
public $mage_description;
public $mage_sub_description;
public $characteristics;
public $mage_guideline;
public $mage_associated_articles;
public $image_1_src;
public $image_2_src;
public $image_3_src;
public $mage_mediagallery;
public $mage_fichepdf;
public $mage_notice_pose_lpn;
public $mage_invoice_description;
public $mage_realisations;
public $mage_realisationsJson;
public $mage_config_description;
public $mage_re_skus;
public $mage_produitspose;
public $mage_produitsfinition;
public $mage_produitsentretien;
public $mage_cs_skus;
public $mage_origine_arbre;
public $configurableFields;
public $childrenSimpleProductIds_flat;
public $teinte_lpn;
public $mage_tags;


/**
* @param array $values
* @return \Pimcore\Model\Object\Product
*/
public static function create($values = array()) {
	$object = new static();
	$object->setValues($values);
	return $object;
}

/**
* Get actif_web - Actif Web ?
* @return boolean
*/
public function getActif_web () {
	$preValue = $this->preGetValue("actif_web"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->actif_web;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("actif_web")->isEmpty($data)) {
		return $this->getValueFromParent("actif_web");
	}
	return $data;
}

/**
* Set actif_web - Actif Web ?
* @param boolean $actif_web
* @return \Pimcore\Model\Object\Product
*/
public function setActif_web ($actif_web) {
	$this->actif_web = $actif_web;
	return $this;
}

/**
* Get obsolete - Obsolete ?
* @return boolean
*/
public function getObsolete () {
	$preValue = $this->preGetValue("obsolete"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->obsolete;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("obsolete")->isEmpty($data)) {
		return $this->getValueFromParent("obsolete");
	}
	return $data;
}

/**
* Set obsolete - Obsolete ?
* @param boolean $obsolete
* @return \Pimcore\Model\Object\Product
*/
public function setObsolete ($obsolete) {
	$this->obsolete = $obsolete;
	return $this;
}

/**
* Get echantillon - Echantillon disponible ?
* @return boolean
*/
public function getEchantillon () {
	$preValue = $this->preGetValue("echantillon"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->echantillon;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("echantillon")->isEmpty($data)) {
		return $this->getValueFromParent("echantillon");
	}
	return $data;
}

/**
* Set echantillon - Echantillon disponible ?
* @param boolean $echantillon
* @return \Pimcore\Model\Object\Product
*/
public function setEchantillon ($echantillon) {
	$this->echantillon = $echantillon;
	return $this;
}

/**
* Get pimonly_print_label - Label pour etiquettes
* @return string
*/
public function getPimonly_print_label () {
	$preValue = $this->preGetValue("pimonly_print_label"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_print_label;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_print_label")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_print_label");
	}
	return $data;
}

/**
* Set pimonly_print_label - Label pour etiquettes
* @param string $pimonly_print_label
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_print_label ($pimonly_print_label) {
	$this->pimonly_print_label = $pimonly_print_label;
	return $this;
}

/**
* Get pimonly_equivalence_auto - Equivalence Autom.
* @return string
*/
public function getPimonly_equivalence_auto () {
	$preValue = $this->preGetValue("pimonly_equivalence_auto"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_equivalence_auto;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_equivalence_auto")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_equivalence_auto");
	}
	return $data;
}

/**
* Set pimonly_equivalence_auto - Equivalence Autom.
* @param string $pimonly_equivalence_auto
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_equivalence_auto ($pimonly_equivalence_auto) {
	$this->pimonly_equivalence_auto = $pimonly_equivalence_auto;
	return $this;
}

/**
* Get pimonly_equivalence - Equivalence
* @return string
*/
public function getPimonly_equivalence () {
	$preValue = $this->preGetValue("pimonly_equivalence"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_equivalence;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_equivalence")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_equivalence");
	}
	return $data;
}

/**
* Set pimonly_equivalence - Equivalence
* @param string $pimonly_equivalence
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_equivalence ($pimonly_equivalence) {
	$this->pimonly_equivalence = $pimonly_equivalence;
	return $this;
}

/**
* Get code - Code Article
* @return string
*/
public function getCode () {
	$preValue = $this->preGetValue("code"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->code;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("code")->isEmpty($data)) {
		return $this->getValueFromParent("code");
	}
	return $data;
}

/**
* Set code - Code Article
* @param string $code
* @return \Pimcore\Model\Object\Product
*/
public function setCode ($code) {
	$this->code = $code;
	return $this;
}

/**
* Get ean - EAN
* @return string
*/
public function getEan () {
	$preValue = $this->preGetValue("ean"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->ean;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("ean")->isEmpty($data)) {
		return $this->getValueFromParent("ean");
	}
	return $data;
}

/**
* Set ean - EAN
* @param string $ean
* @return \Pimcore\Model\Object\Product
*/
public function setEan ($ean) {
	$this->ean = $ean;
	return $this;
}

/**
* Get plusValue - Plus Value
* @return \Pimcore\Model\Object\product
*/
public function getPlusValue () {
	$preValue = $this->preGetValue("plusValue"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("plusValue")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("plusValue")->isEmpty($data)) {
		return $this->getValueFromParent("plusValue");
	}
	return $data;
}

/**
* Set plusValue - Plus Value
* @param \Pimcore\Model\Object\product $plusValue
* @return \Pimcore\Model\Object\Product
*/
public function setPlusValue ($plusValue) {
	$this->plusValue = $this->getClass()->getFieldDefinition("plusValue")->preSetData($this, $plusValue);
	return $this;
}

/**
* Get name_scienergie - Nom scienergie
* @return string
*/
public function getName_scienergie () {
	$preValue = $this->preGetValue("name_scienergie"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie");
	}
	return $data;
}

/**
* Set name_scienergie - Nom scienergie
* @param string $name_scienergie
* @return \Pimcore\Model\Object\Product
*/
public function setName_scienergie ($name_scienergie) {
	$this->name_scienergie = $name_scienergie;
	return $this;
}

/**
* Get name_scienergie_court - Nom scienergie Court
* @return string
*/
public function getName_scienergie_court () {
	$preValue = $this->preGetValue("name_scienergie_court"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie_court;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie_court")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie_court");
	}
	return $data;
}

/**
* Set name_scienergie_court - Nom scienergie Court
* @param string $name_scienergie_court
* @return \Pimcore\Model\Object\Product
*/
public function setName_scienergie_court ($name_scienergie_court) {
	$this->name_scienergie_court = $name_scienergie_court;
	return $this;
}

/**
* Get catalogue - Catalogue
* @return string
*/
public function getCatalogue () {
	$preValue = $this->preGetValue("catalogue"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->catalogue;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("catalogue")->isEmpty($data)) {
		return $this->getValueFromParent("catalogue");
	}
	return $data;
}

/**
* Set catalogue - Catalogue
* @param string $catalogue
* @return \Pimcore\Model\Object\Product
*/
public function setCatalogue ($catalogue) {
	$this->catalogue = $catalogue;
	return $this;
}

/**
* Get product_type - Type de produit
* @return string
*/
public function getProduct_type () {
	$preValue = $this->preGetValue("product_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->product_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("product_type")->isEmpty($data)) {
		return $this->getValueFromParent("product_type");
	}
	return $data;
}

/**
* Set product_type - Type de produit
* @param string $product_type
* @return \Pimcore\Model\Object\Product
*/
public function setProduct_type ($product_type) {
	$this->product_type = $product_type;
	return $this;
}

/**
* Get subtype - Type
* @return string
*/
public function getSubtype () {
	$preValue = $this->preGetValue("subtype"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->subtype;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("subtype")->isEmpty($data)) {
		return $this->getValueFromParent("subtype");
	}
	return $data;
}

/**
* Set subtype - Type
* @param string $subtype
* @return \Pimcore\Model\Object\Product
*/
public function setSubtype ($subtype) {
	$this->subtype = $subtype;
	return $this;
}

/**
* Get subtype2 - Catégorie
* @return string
*/
public function getSubtype2 () {
	$preValue = $this->preGetValue("subtype2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->subtype2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("subtype2")->isEmpty($data)) {
		return $this->getValueFromParent("subtype2");
	}
	return $data;
}

/**
* Set subtype2 - Catégorie
* @param string $subtype2
* @return \Pimcore\Model\Object\Product
*/
public function setSubtype2 ($subtype2) {
	$this->subtype2 = $subtype2;
	return $this;
}

/**
* Get pimonly_teinte_rel - Teinte
* @return \Pimcore\Model\Object\teinte[]
*/
public function getPimonly_teinte_rel () {
	$preValue = $this->preGetValue("pimonly_teinte_rel"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("pimonly_teinte_rel")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_teinte_rel")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_teinte_rel");
	}
	return $data;
}

/**
* Set pimonly_teinte_rel - Teinte
* @param \Pimcore\Model\Object\teinte[] $pimonly_teinte_rel
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_teinte_rel ($pimonly_teinte_rel) {
	$this->pimonly_teinte_rel = $this->getClass()->getFieldDefinition("pimonly_teinte_rel")->preSetData($this, $pimonly_teinte_rel);
	return $this;
}

/**
* Get teinte_type - Type de teinte
* @return string
*/
public function getTeinte_type () {
	$preValue = $this->preGetValue("teinte_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->teinte_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("teinte_type")->isEmpty($data)) {
		return $this->getValueFromParent("teinte_type");
	}
	return $data;
}

/**
* Set teinte_type - Type de teinte
* @param string $teinte_type
* @return \Pimcore\Model\Object\Product
*/
public function setTeinte_type ($teinte_type) {
	$this->teinte_type = $teinte_type;
	return $this;
}

/**
* Get name_scienergie_converti - Nom scienergie Converti
* @return string
*/
public function getName_scienergie_converti () {
	$preValue = $this->preGetValue("name_scienergie_converti"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie_converti;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie_converti")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie_converti");
	}
	return $data;
}

/**
* Set name_scienergie_converti - Nom scienergie Converti
* @param string $name_scienergie_converti
* @return \Pimcore\Model\Object\Product
*/
public function setName_scienergie_converti ($name_scienergie_converti) {
	$this->name_scienergie_converti = $name_scienergie_converti;
	return $this;
}

/**
* Get name_scienergie2 - Nom scienergie 2
* @return string
*/
public function getName_scienergie2 () {
	$preValue = $this->preGetValue("name_scienergie2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name_scienergie2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name_scienergie2")->isEmpty($data)) {
		return $this->getValueFromParent("name_scienergie2");
	}
	return $data;
}

/**
* Set name_scienergie2 - Nom scienergie 2
* @param string $name_scienergie2
* @return \Pimcore\Model\Object\Product
*/
public function setName_scienergie2 ($name_scienergie2) {
	$this->name_scienergie2 = $name_scienergie2;
	return $this;
}

/**
* Get name - Name
* @return string
*/
public function getName () {
	$preValue = $this->preGetValue("name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("name")->isEmpty($data)) {
		return $this->getValueFromParent("name");
	}
	return $data;
}

/**
* Set name - Name
* @param string $name
* @return \Pimcore\Model\Object\Product
*/
public function setName ($name) {
	$this->name = $name;
	return $this;
}

/**
* Get short_name - Nom court
* @return string
*/
public function getShort_name () {
	$preValue = $this->preGetValue("short_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_name")->isEmpty($data)) {
		return $this->getValueFromParent("short_name");
	}
	return $data;
}

/**
* Set short_name - Nom court
* @param string $short_name
* @return \Pimcore\Model\Object\Product
*/
public function setShort_name ($short_name) {
	$this->short_name = $short_name;
	return $this;
}

/**
* Get pimonly_name_suffixe - Suffixe Nom
* @return string
*/
public function getPimonly_name_suffixe () {
	$preValue = $this->preGetValue("pimonly_name_suffixe"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_name_suffixe;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_name_suffixe")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_name_suffixe");
	}
	return $data;
}

/**
* Set pimonly_name_suffixe - Suffixe Nom
* @param string $pimonly_name_suffixe
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_name_suffixe ($pimonly_name_suffixe) {
	$this->pimonly_name_suffixe = $pimonly_name_suffixe;
	return $this;
}

/**
* Get pimonly_dimensions - Dimensions générées
* @return string
*/
public function getPimonly_dimensions () {
	$preValue = $this->preGetValue("pimonly_dimensions"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_dimensions;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_dimensions")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_dimensions");
	}
	return $data;
}

/**
* Set pimonly_dimensions - Dimensions générées
* @param string $pimonly_dimensions
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_dimensions ($pimonly_dimensions) {
	$this->pimonly_dimensions = $pimonly_dimensions;
	return $this;
}

/**
* Get short_description - Description courte / Accroche
* @return string
*/
public function getShort_description () {
	$preValue = $this->preGetValue("short_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_description")->isEmpty($data)) {
		return $this->getValueFromParent("short_description");
	}
	return $data;
}

/**
* Set short_description - Description courte / Accroche
* @param string $short_description
* @return \Pimcore\Model\Object\Product
*/
public function setShort_description ($short_description) {
	$this->short_description = $short_description;
	return $this;
}

/**
* Get short_description_title - Description titre
* @return string
*/
public function getShort_description_title () {
	$preValue = $this->preGetValue("short_description_title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->short_description_title;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("short_description_title")->isEmpty($data)) {
		return $this->getValueFromParent("short_description_title");
	}
	return $data;
}

/**
* Set short_description_title - Description titre
* @param string $short_description_title
* @return \Pimcore\Model\Object\Product
*/
public function setShort_description_title ($short_description_title) {
	$this->short_description_title = $short_description_title;
	return $this;
}

/**
* Get description - Description
* @return string
*/
public function getDescription () {
	$preValue = $this->preGetValue("description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("description")->isEmpty($data)) {
		return $this->getValueFromParent("description");
	}
	return $data;
}

/**
* Set description - Description
* @param string $description
* @return \Pimcore\Model\Object\Product
*/
public function setDescription ($description) {
	$this->description = $description;
	return $this;
}

/**
* Get pimonly_sub_description_prefixe - Dimensions et autre caracteristiques EAN
* @return string
*/
public function getPimonly_sub_description_prefixe () {
	$preValue = $this->preGetValue("pimonly_sub_description_prefixe"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_sub_description_prefixe;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_sub_description_prefixe")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_sub_description_prefixe");
	}
	return $data;
}

/**
* Set pimonly_sub_description_prefixe - Dimensions et autre caracteristiques EAN
* @param string $pimonly_sub_description_prefixe
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_sub_description_prefixe ($pimonly_sub_description_prefixe) {
	$this->pimonly_sub_description_prefixe = $pimonly_sub_description_prefixe;
	return $this;
}

/**
* Get pimonly_sub_description - Sous description / Liste de caract. commune
* @return string
*/
public function getPimonly_sub_description () {
	$preValue = $this->preGetValue("pimonly_sub_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_sub_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_sub_description")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_sub_description");
	}
	return $data;
}

/**
* Set pimonly_sub_description - Sous description / Liste de caract. commune
* @param string $pimonly_sub_description
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_sub_description ($pimonly_sub_description) {
	$this->pimonly_sub_description = $pimonly_sub_description;
	return $this;
}

/**
* Get extra_content1 - Contenu supplémenataire
* @return string
*/
public function getExtra_content1 () {
	$preValue = $this->preGetValue("extra_content1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("extra_content1")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("extra_content1")->isEmpty($data)) {
		return $this->getValueFromParent("extra_content1");
	}
	return $data;
}

/**
* Set extra_content1 - Contenu supplémenataire
* @param string $extra_content1
* @return \Pimcore\Model\Object\Product
*/
public function setExtra_content1 ($extra_content1) {
	$this->extra_content1 = $extra_content1;
	return $this;
}

/**
* Get lesplus - Les Plus / Vous aimerez
* @return string
*/
public function getLesplus () {
	$preValue = $this->preGetValue("lesplus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->lesplus;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("lesplus")->isEmpty($data)) {
		return $this->getValueFromParent("lesplus");
	}
	return $data;
}

/**
* Set lesplus - Les Plus / Vous aimerez
* @param string $lesplus
* @return \Pimcore\Model\Object\Product
*/
public function setLesplus ($lesplus) {
	$this->lesplus = $lesplus;
	return $this;
}

/**
* Get remarque - Remarque
* @return string
*/
public function getRemarque () {
	$preValue = $this->preGetValue("remarque"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->remarque;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("remarque")->isEmpty($data)) {
		return $this->getValueFromParent("remarque");
	}
	return $data;
}

/**
* Set remarque - Remarque
* @param string $remarque
* @return \Pimcore\Model\Object\Product
*/
public function setRemarque ($remarque) {
	$this->remarque = $remarque;
	return $this;
}

/**
* Get no_stock_delay - Délai de livraison (Display)
* @return string
*/
public function getNo_stock_delay () {
	$preValue = $this->preGetValue("no_stock_delay"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->no_stock_delay;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("no_stock_delay")->isEmpty($data)) {
		return $this->getValueFromParent("no_stock_delay");
	}
	return $data;
}

/**
* Set no_stock_delay - Délai de livraison (Display)
* @param string $no_stock_delay
* @return \Pimcore\Model\Object\Product
*/
public function setNo_stock_delay ($no_stock_delay) {
	$this->no_stock_delay = $no_stock_delay;
	return $this;
}

/**
* Get leadtime - Délai de Livraison
* @return string
*/
public function getLeadtime () {
	$preValue = $this->preGetValue("leadtime"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->leadtime;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("leadtime")->isEmpty($data)) {
		return $this->getValueFromParent("leadtime");
	}
	return $data;
}

/**
* Set leadtime - Délai de Livraison
* @param string $leadtime
* @return \Pimcore\Model\Object\Product
*/
public function setLeadtime ($leadtime) {
	$this->leadtime = $leadtime;
	return $this;
}

/**
* Get shipping_type - Type de Livraison
* @return string
*/
public function getShipping_type () {
	$preValue = $this->preGetValue("shipping_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->shipping_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("shipping_type")->isEmpty($data)) {
		return $this->getValueFromParent("shipping_type");
	}
	return $data;
}

/**
* Set shipping_type - Type de Livraison
* @param string $shipping_type
* @return \Pimcore\Model\Object\Product
*/
public function setShipping_type ($shipping_type) {
	$this->shipping_type = $shipping_type;
	return $this;
}

/**
* Get mage_qty_description - Description Quantité, Surface
* @return string
*/
public function getMage_qty_description () {
	$preValue = $this->preGetValue("mage_qty_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_qty_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_qty_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_qty_description");
	}
	return $data;
}

/**
* Set mage_qty_description - Description Quantité, Surface
* @param string $mage_qty_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_qty_description ($mage_qty_description) {
	$this->mage_qty_description = $mage_qty_description;
	return $this;
}

/**
* Get mage_custom_option - Custom Option pour Magento, espéré par un /
* @return string
*/
public function getMage_custom_option () {
	$preValue = $this->preGetValue("mage_custom_option"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_custom_option;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_custom_option")->isEmpty($data)) {
		return $this->getValueFromParent("mage_custom_option");
	}
	return $data;
}

/**
* Set mage_custom_option - Custom Option pour Magento, espéré par un /
* @param string $mage_custom_option
* @return \Pimcore\Model\Object\Product
*/
public function setMage_custom_option ($mage_custom_option) {
	$this->mage_custom_option = $mage_custom_option;
	return $this;
}

/**
* Get image_1 - Base Img / Lifestyle
* @return \Pimcore\Model\Asset\Image
*/
public function getImage_1 () {
	$preValue = $this->preGetValue("image_1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_1;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_1")->isEmpty($data)) {
		return $this->getValueFromParent("image_1");
	}
	return $data;
}

/**
* Set image_1 - Base Img / Lifestyle
* @param \Pimcore\Model\Asset\Image $image_1
* @return \Pimcore\Model\Object\Product
*/
public function setImage_1 ($image_1) {
	$this->image_1 = $image_1;
	return $this;
}

/**
* Get image_2 - Small Img / packshot
* @return \Pimcore\Model\Asset\Image
*/
public function getImage_2 () {
	$preValue = $this->preGetValue("image_2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_2")->isEmpty($data)) {
		return $this->getValueFromParent("image_2");
	}
	return $data;
}

/**
* Set image_2 - Small Img / packshot
* @param \Pimcore\Model\Asset\Image $image_2
* @return \Pimcore\Model\Object\Product
*/
public function setImage_2 ($image_2) {
	$this->image_2 = $image_2;
	return $this;
}

/**
* Get image_3 - Thumb Img / Zoom 1
* @return \Pimcore\Model\Asset\Image
*/
public function getImage_3 () {
	$preValue = $this->preGetValue("image_3"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_3;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_3")->isEmpty($data)) {
		return $this->getValueFromParent("image_3");
	}
	return $data;
}

/**
* Set image_3 - Thumb Img / Zoom 1
* @param \Pimcore\Model\Asset\Image $image_3
* @return \Pimcore\Model\Object\Product
*/
public function setImage_3 ($image_3) {
	$this->image_3 = $image_3;
	return $this;
}

/**
* Get image_4 - Thumb Img 2 / Zoom 2
* @return \Pimcore\Model\Asset\Image
*/
public function getImage_4 () {
	$preValue = $this->preGetValue("image_4"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_4;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_4")->isEmpty($data)) {
		return $this->getValueFromParent("image_4");
	}
	return $data;
}

/**
* Set image_4 - Thumb Img 2 / Zoom 2
* @param \Pimcore\Model\Asset\Image $image_4
* @return \Pimcore\Model\Object\Product
*/
public function setImage_4 ($image_4) {
	$this->image_4 = $image_4;
	return $this;
}

/**
* Get image_texture - Image (texture / face)
* @return \Pimcore\Model\Asset\Image
*/
public function getImage_texture () {
	$preValue = $this->preGetValue("image_texture"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_texture;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_texture")->isEmpty($data)) {
		return $this->getValueFromParent("image_texture");
	}
	return $data;
}

/**
* Set image_texture - Image (texture / face)
* @param \Pimcore\Model\Asset\Image $image_texture
* @return \Pimcore\Model\Object\Product
*/
public function setImage_texture ($image_texture) {
	$this->image_texture = $image_texture;
	return $this;
}

/**
* Get gallery - Autres Images pour la galerie
* @return \Pimcore\Model\Asset\image[]
*/
public function getGallery () {
	$preValue = $this->preGetValue("gallery"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("gallery")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("gallery")->isEmpty($data)) {
		return $this->getValueFromParent("gallery");
	}
	return $data;
}

/**
* Set gallery - Autres Images pour la galerie
* @param \Pimcore\Model\Asset\image[] $gallery
* @return \Pimcore\Model\Object\Product
*/
public function setGallery ($gallery) {
	$this->gallery = $this->getClass()->getFieldDefinition("gallery")->preSetData($this, $gallery);
	return $this;
}

/**
* Get chauffantBasseTemperature - Compatible sol chauffant basse température
* @return string
*/
public function getChauffantBasseTemperature () {
	$preValue = $this->preGetValue("chauffantBasseTemperature"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chauffantBasseTemperature;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chauffantBasseTemperature")->isEmpty($data)) {
		return $this->getValueFromParent("chauffantBasseTemperature");
	}
	return $data;
}

/**
* Set chauffantBasseTemperature - Compatible sol chauffant basse température
* @param string $chauffantBasseTemperature
* @return \Pimcore\Model\Object\Product
*/
public function setChauffantBasseTemperature ($chauffantBasseTemperature) {
	$this->chauffantBasseTemperature = $chauffantBasseTemperature;
	return $this;
}

/**
* Get pimonly_chauffantBasseTemperature - Compatible sol chauffant basse température DTU (Calculé)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getPimonly_chauffantBasseTemperature () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('pimonly_chauffantBasseTemperature');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set pimonly_chauffantBasseTemperature - Compatible sol chauffant basse température DTU (Calculé)
* @param \Pimcore\Model\Object\Data\CalculatedValue $pimonly_chauffantBasseTemperature
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_chauffantBasseTemperature ($pimonly_chauffantBasseTemperature) {
	return $this;
}

/**
* Get chauffantRadiantElectrique - Compatible sol chauffant radiant électrique
* @return string
*/
public function getChauffantRadiantElectrique () {
	$preValue = $this->preGetValue("chauffantRadiantElectrique"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chauffantRadiantElectrique;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chauffantRadiantElectrique")->isEmpty($data)) {
		return $this->getValueFromParent("chauffantRadiantElectrique");
	}
	return $data;
}

/**
* Set chauffantRadiantElectrique - Compatible sol chauffant radiant électrique
* @param string $chauffantRadiantElectrique
* @return \Pimcore\Model\Object\Product
*/
public function setChauffantRadiantElectrique ($chauffantRadiantElectrique) {
	$this->chauffantRadiantElectrique = $chauffantRadiantElectrique;
	return $this;
}

/**
* Get pimonly_chauffantRadiantElectrique - Compatible sol chauffant radiant électrique  DTU (Calculé)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getPimonly_chauffantRadiantElectrique () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('pimonly_chauffantRadiantElectrique');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set pimonly_chauffantRadiantElectrique - Compatible sol chauffant radiant électrique  DTU (Calculé)
* @param \Pimcore\Model\Object\Data\CalculatedValue $pimonly_chauffantRadiantElectrique
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_chauffantRadiantElectrique ($pimonly_chauffantRadiantElectrique) {
	return $this;
}

/**
* Get solRaffraichissant - Compatible sol chauffant réversible
* @return string
*/
public function getSolRaffraichissant () {
	$preValue = $this->preGetValue("solRaffraichissant"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->solRaffraichissant;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("solRaffraichissant")->isEmpty($data)) {
		return $this->getValueFromParent("solRaffraichissant");
	}
	return $data;
}

/**
* Set solRaffraichissant - Compatible sol chauffant réversible
* @param string $solRaffraichissant
* @return \Pimcore\Model\Object\Product
*/
public function setSolRaffraichissant ($solRaffraichissant) {
	$this->solRaffraichissant = $solRaffraichissant;
	return $this;
}

/**
* Get pimonly_solRaffraichissant - Compatible sol chauffant réversible DTU (Calculé)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getPimonly_solRaffraichissant () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('pimonly_solRaffraichissant');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set pimonly_solRaffraichissant - Compatible sol chauffant réversible DTU (Calculé)
* @param \Pimcore\Model\Object\Data\CalculatedValue $pimonly_solRaffraichissant
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_solRaffraichissant ($pimonly_solRaffraichissant) {
	return $this;
}

/**
* Get chauffantAccumulationBasseTemperature - Compatible à accumulation basse température
* @return string
*/
public function getChauffantAccumulationBasseTemperature () {
	$preValue = $this->preGetValue("chauffantAccumulationBasseTemperature"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chauffantAccumulationBasseTemperature;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chauffantAccumulationBasseTemperature")->isEmpty($data)) {
		return $this->getValueFromParent("chauffantAccumulationBasseTemperature");
	}
	return $data;
}

/**
* Set chauffantAccumulationBasseTemperature - Compatible à accumulation basse température
* @param string $chauffantAccumulationBasseTemperature
* @return \Pimcore\Model\Object\Product
*/
public function setChauffantAccumulationBasseTemperature ($chauffantAccumulationBasseTemperature) {
	$this->chauffantAccumulationBasseTemperature = $chauffantAccumulationBasseTemperature;
	return $this;
}

/**
* Get essence - Essence
* @return string
*/
public function getEssence () {
	$preValue = $this->preGetValue("essence"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->essence;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("essence")->isEmpty($data)) {
		return $this->getValueFromParent("essence");
	}
	return $data;
}

/**
* Set essence - Essence
* @param string $essence
* @return \Pimcore\Model\Object\Product
*/
public function setEssence ($essence) {
	$this->essence = $essence;
	return $this;
}

/**
* Get support - Support / âme
* @return string
*/
public function getSupport () {
	$preValue = $this->preGetValue("support"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->support;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("support")->isEmpty($data)) {
		return $this->getValueFromParent("support");
	}
	return $data;
}

/**
* Set support - Support / âme
* @param string $support
* @return \Pimcore\Model\Object\Product
*/
public function setSupport ($support) {
	$this->support = $support;
	return $this;
}

/**
* Get epaisseurUsure - Ep. couche d'usure
* @return string
*/
public function getEpaisseurUsure () {
	$preValue = $this->preGetValue("epaisseurUsure"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseurUsure;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseurUsure")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseurUsure");
	}
	return $data;
}

/**
* Set epaisseurUsure - Ep. couche d'usure
* @param string $epaisseurUsure
* @return \Pimcore\Model\Object\Product
*/
public function setEpaisseurUsure ($epaisseurUsure) {
	$this->epaisseurUsure = $epaisseurUsure;
	return $this;
}

/**
* Get norme_sanitaire - Norme Sanitaire
* @return string
*/
public function getNorme_sanitaire () {
	$preValue = $this->preGetValue("norme_sanitaire"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->norme_sanitaire;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("norme_sanitaire")->isEmpty($data)) {
		return $this->getValueFromParent("norme_sanitaire");
	}
	return $data;
}

/**
* Set norme_sanitaire - Norme Sanitaire
* @param string $norme_sanitaire
* @return \Pimcore\Model\Object\Product
*/
public function setNorme_sanitaire ($norme_sanitaire) {
	$this->norme_sanitaire = $norme_sanitaire;
	return $this;
}

/**
* Get classe - Classe d'usage
* @return string
*/
public function getClasse () {
	$preValue = $this->preGetValue("classe"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->classe;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("classe")->isEmpty($data)) {
		return $this->getValueFromParent("classe");
	}
	return $data;
}

/**
* Set classe - Classe d'usage
* @param string $classe
* @return \Pimcore\Model\Object\Product
*/
public function setClasse ($classe) {
	$this->classe = $classe;
	return $this;
}

/**
* Get classe_utilisation - Classe d'utilisation
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_utilisation () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('classe_utilisation');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set classe_utilisation - Classe d'utilisation
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_utilisation
* @return \Pimcore\Model\Object\Product
*/
public function setClasse_utilisation ($classe_utilisation) {
	return $this;
}

/**
* Get pimonly_classe_utilisation - Classe d'utilisation (fournisseur)
* @return string
*/
public function getPimonly_classe_utilisation () {
	$preValue = $this->preGetValue("pimonly_classe_utilisation"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_classe_utilisation;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_classe_utilisation")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_classe_utilisation");
	}
	return $data;
}

/**
* Set pimonly_classe_utilisation - Classe d'utilisation (fournisseur)
* @param string $pimonly_classe_utilisation
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_classe_utilisation ($pimonly_classe_utilisation) {
	$this->pimonly_classe_utilisation = $pimonly_classe_utilisation;
	return $this;
}

/**
* Get classe_upec - Classement UPEC
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_upec () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('classe_upec');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set classe_upec - Classement UPEC
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_upec
* @return \Pimcore\Model\Object\Product
*/
public function setClasse_upec ($classe_upec) {
	return $this;
}

/**
* Get pimonly_classe_upec - Classement UPEC  (fournisseur)
* @return string
*/
public function getPimonly_classe_upec () {
	$preValue = $this->preGetValue("pimonly_classe_upec"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_classe_upec;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_classe_upec")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_classe_upec");
	}
	return $data;
}

/**
* Set pimonly_classe_upec - Classement UPEC  (fournisseur)
* @param string $pimonly_classe_upec
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_classe_upec ($pimonly_classe_upec) {
	$this->pimonly_classe_upec = $pimonly_classe_upec;
	return $this;
}

/**
* Get masse_volumique - Masse volumique (kg/m3)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getMasse_volumique () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('masse_volumique');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set masse_volumique - Masse volumique (kg/m3)
* @param \Pimcore\Model\Object\Data\CalculatedValue $masse_volumique
* @return \Pimcore\Model\Object\Product
*/
public function setMasse_volumique ($masse_volumique) {
	return $this;
}

/**
* Get pimonly_masse_volumique_moyenne - Masse volumique moyenne fournisseur
* @return string
*/
public function getPimonly_masse_volumique_moyenne () {
	$preValue = $this->preGetValue("pimonly_masse_volumique_moyenne"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_masse_volumique_moyenne;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_masse_volumique_moyenne")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_masse_volumique_moyenne");
	}
	return $data;
}

/**
* Set pimonly_masse_volumique_moyenne - Masse volumique moyenne fournisseur
* @param string $pimonly_masse_volumique_moyenne
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_masse_volumique_moyenne ($pimonly_masse_volumique_moyenne) {
	$this->pimonly_masse_volumique_moyenne = $pimonly_masse_volumique_moyenne;
	return $this;
}

/**
* Get classe_reaction_feu_eu - Classement feu (NF EN 13501-1)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_reaction_feu_eu () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('classe_reaction_feu_eu');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set classe_reaction_feu_eu - Classement feu (NF EN 13501-1)
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_reaction_feu_eu
* @return \Pimcore\Model\Object\Product
*/
public function setClasse_reaction_feu_eu ($classe_reaction_feu_eu) {
	return $this;
}

/**
* Get pimonly_classe_reaction_feu_eu - Classement feu (NF EN 13501-1)
* @return string
*/
public function getPimonly_classe_reaction_feu_eu () {
	$preValue = $this->preGetValue("pimonly_classe_reaction_feu_eu"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_classe_reaction_feu_eu;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_classe_reaction_feu_eu")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_classe_reaction_feu_eu");
	}
	return $data;
}

/**
* Set pimonly_classe_reaction_feu_eu - Classement feu (NF EN 13501-1)
* @param string $pimonly_classe_reaction_feu_eu
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_classe_reaction_feu_eu ($pimonly_classe_reaction_feu_eu) {
	$this->pimonly_classe_reaction_feu_eu = $pimonly_classe_reaction_feu_eu;
	return $this;
}

/**
* Get classe_reaction_feu_fr - Classement feu (NF P 92 507)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getClasse_reaction_feu_fr () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('classe_reaction_feu_fr');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set classe_reaction_feu_fr - Classement feu (NF P 92 507)
* @param \Pimcore\Model\Object\Data\CalculatedValue $classe_reaction_feu_fr
* @return \Pimcore\Model\Object\Product
*/
public function setClasse_reaction_feu_fr ($classe_reaction_feu_fr) {
	return $this;
}

/**
* Get pimonly_classe_reaction_feu_fr - Classement feu (NF P 92 507)
* @return string
*/
public function getPimonly_classe_reaction_feu_fr () {
	$preValue = $this->preGetValue("pimonly_classe_reaction_feu_fr"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_classe_reaction_feu_fr;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_classe_reaction_feu_fr")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_classe_reaction_feu_fr");
	}
	return $data;
}

/**
* Set pimonly_classe_reaction_feu_fr - Classement feu (NF P 92 507)
* @param string $pimonly_classe_reaction_feu_fr
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_classe_reaction_feu_fr ($pimonly_classe_reaction_feu_fr) {
	$this->pimonly_classe_reaction_feu_fr = $pimonly_classe_reaction_feu_fr;
	return $this;
}

/**
* Get degagement_formaldehyde - Dégagement formaldéhyde
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getDegagement_formaldehyde () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('degagement_formaldehyde');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set degagement_formaldehyde - Dégagement formaldéhyde
* @param \Pimcore\Model\Object\Data\CalculatedValue $degagement_formaldehyde
* @return \Pimcore\Model\Object\Product
*/
public function setDegagement_formaldehyde ($degagement_formaldehyde) {
	return $this;
}

/**
* Get resistance_thermique - Résistance thermique (en m2/KW)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getResistance_thermique () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('resistance_thermique');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set resistance_thermique - Résistance thermique (en m2/KW)
* @param \Pimcore\Model\Object\Data\CalculatedValue $resistance_thermique
* @return \Pimcore\Model\Object\Product
*/
public function setResistance_thermique ($resistance_thermique) {
	return $this;
}

/**
* Get pimonly_resistance_thermique - Résistance thermique Fournisseur
* @return string
*/
public function getPimonly_resistance_thermique () {
	$preValue = $this->preGetValue("pimonly_resistance_thermique"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_resistance_thermique;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_resistance_thermique")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_resistance_thermique");
	}
	return $data;
}

/**
* Set pimonly_resistance_thermique - Résistance thermique Fournisseur
* @param string $pimonly_resistance_thermique
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_resistance_thermique ($pimonly_resistance_thermique) {
	$this->pimonly_resistance_thermique = $pimonly_resistance_thermique;
	return $this;
}

/**
* Get conductivite_thermique_total - Conductivite thermique totale (en W/mK)
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getConductivite_thermique_total () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('conductivite_thermique_total');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set conductivite_thermique_total - Conductivite thermique totale (en W/mK)
* @param \Pimcore\Model\Object\Data\CalculatedValue $conductivite_thermique_total
* @return \Pimcore\Model\Object\Product
*/
public function setConductivite_thermique_total ($conductivite_thermique_total) {
	return $this;
}

/**
* Get pimonly_conductivite_thermique_total - Conductivite thermique totale (founisseur)
* @return string
*/
public function getPimonly_conductivite_thermique_total () {
	$preValue = $this->preGetValue("pimonly_conductivite_thermique_total"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_conductivite_thermique_total;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_conductivite_thermique_total")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_conductivite_thermique_total");
	}
	return $data;
}

/**
* Set pimonly_conductivite_thermique_total - Conductivite thermique totale (founisseur)
* @param string $pimonly_conductivite_thermique_total
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_conductivite_thermique_total ($pimonly_conductivite_thermique_total) {
	$this->pimonly_conductivite_thermique_total = $pimonly_conductivite_thermique_total;
	return $this;
}

/**
* Get condition_mise_en_oeuvre - Condition de mise en oeuvre
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getCondition_mise_en_oeuvre () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('condition_mise_en_oeuvre');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set condition_mise_en_oeuvre - Condition de mise en oeuvre
* @param \Pimcore\Model\Object\Data\CalculatedValue $condition_mise_en_oeuvre
* @return \Pimcore\Model\Object\Product
*/
public function setCondition_mise_en_oeuvre ($condition_mise_en_oeuvre) {
	return $this;
}

/**
* Get taux_humidite - Taux d'humidité sortie d'usine
* @return string
*/
public function getTaux_humidite () {
	$preValue = $this->preGetValue("taux_humidite"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->taux_humidite;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("taux_humidite")->isEmpty($data)) {
		return $this->getValueFromParent("taux_humidite");
	}
	return $data;
}

/**
* Set taux_humidite - Taux d'humidité sortie d'usine
* @param string $taux_humidite
* @return \Pimcore\Model\Object\Product
*/
public function setTaux_humidite ($taux_humidite) {
	$this->taux_humidite = $taux_humidite;
	return $this;
}

/**
* Get coefficient_retractabilite - Coefficient rétractabilite
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getCoefficient_retractabilite () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('coefficient_retractabilite');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set coefficient_retractabilite - Coefficient rétractabilite
* @param \Pimcore\Model\Object\Data\CalculatedValue $coefficient_retractabilite
* @return \Pimcore\Model\Object\Product
*/
public function setCoefficient_retractabilite ($coefficient_retractabilite) {
	return $this;
}

/**
* Get durabilite_ecologique - Durabilité écologique
* @return \Pimcore\Model\Object\Data\CalculatedValue
*/
public function getDurabilite_ecologique () {
	$data = new \Pimcore\Model\Object\Data\CalculatedValue('durabilite_ecologique');
	$data->setContextualData("object", null, null, null);
	$data = Service::getCalculatedFieldValue($this, $data);
	return $data;
	}

/**
* Set durabilite_ecologique - Durabilité écologique
* @param \Pimcore\Model\Object\Data\CalculatedValue $durabilite_ecologique
* @return \Pimcore\Model\Object\Product
*/
public function setDurabilite_ecologique ($durabilite_ecologique) {
	return $this;
}

/**
* Get largeurString - largeurString
* @return string
*/
public function getLargeurString () {
	$preValue = $this->preGetValue("largeurString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeurString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeurString")->isEmpty($data)) {
		return $this->getValueFromParent("largeurString");
	}
	return $data;
}

/**
* Set largeurString - largeurString
* @param string $largeurString
* @return \Pimcore\Model\Object\Product
*/
public function setLargeurString ($largeurString) {
	$this->largeurString = $largeurString;
	return $this;
}

/**
* Get longueurString - longueurString
* @return string
*/
public function getLongueurString () {
	$preValue = $this->preGetValue("longueurString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueurString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueurString")->isEmpty($data)) {
		return $this->getValueFromParent("longueurString");
	}
	return $data;
}

/**
* Set longueurString - longueurString
* @param string $longueurString
* @return \Pimcore\Model\Object\Product
*/
public function setLongueurString ($longueurString) {
	$this->longueurString = $longueurString;
	return $this;
}

/**
* Get epaisseurString - epaisseurString
* @return string
*/
public function getEpaisseurString () {
	$preValue = $this->preGetValue("epaisseurString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseurString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseurString")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseurString");
	}
	return $data;
}

/**
* Set epaisseurString - epaisseurString
* @param string $epaisseurString
* @return \Pimcore\Model\Object\Product
*/
public function setEpaisseurString ($epaisseurString) {
	$this->epaisseurString = $epaisseurString;
	return $this;
}

/**
* Get choixString - choixString
* @return string
*/
public function getChoixString () {
	$preValue = $this->preGetValue("choixString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->choixString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("choixString")->isEmpty($data)) {
		return $this->getValueFromParent("choixString");
	}
	return $data;
}

/**
* Set choixString - choixString
* @param string $choixString
* @return \Pimcore\Model\Object\Product
*/
public function setChoixString ($choixString) {
	$this->choixString = $choixString;
	return $this;
}

/**
* Get traitement_surfaceString - traitement_surfaceString
* @return string
*/
public function getTraitement_surfaceString () {
	$preValue = $this->preGetValue("traitement_surfaceString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->traitement_surfaceString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("traitement_surfaceString")->isEmpty($data)) {
		return $this->getValueFromParent("traitement_surfaceString");
	}
	return $data;
}

/**
* Set traitement_surfaceString - traitement_surfaceString
* @param string $traitement_surfaceString
* @return \Pimcore\Model\Object\Product
*/
public function setTraitement_surfaceString ($traitement_surfaceString) {
	$this->traitement_surfaceString = $traitement_surfaceString;
	return $this;
}

/**
* Get motifString - motifString
* @return string
*/
public function getMotifString () {
	$preValue = $this->preGetValue("motifString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->motifString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("motifString")->isEmpty($data)) {
		return $this->getValueFromParent("motifString");
	}
	return $data;
}

/**
* Set motifString - motifString
* @param string $motifString
* @return \Pimcore\Model\Object\Product
*/
public function setMotifString ($motifString) {
	$this->motifString = $motifString;
	return $this;
}

/**
* Get finitionString - finitionString
* @return string
*/
public function getFinitionString () {
	$preValue = $this->preGetValue("finitionString"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->finitionString;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("finitionString")->isEmpty($data)) {
		return $this->getValueFromParent("finitionString");
	}
	return $data;
}

/**
* Set finitionString - finitionString
* @param string $finitionString
* @return \Pimcore\Model\Object\Product
*/
public function setFinitionString ($finitionString) {
	$this->finitionString = $finitionString;
	return $this;
}

/**
* Get choix - Choix
* @return string
*/
public function getChoix () {
	$preValue = $this->preGetValue("choix"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->choix;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("choix")->isEmpty($data)) {
		return $this->getValueFromParent("choix");
	}
	return $data;
}

/**
* Set choix - Choix
* @param string $choix
* @return \Pimcore\Model\Object\Product
*/
public function setChoix ($choix) {
	$this->choix = $choix;
	return $this;
}

/**
* Get choix_not_configurable - Choix non configurable
* @return boolean
*/
public function getChoix_not_configurable () {
	$preValue = $this->preGetValue("choix_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->choix_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("choix_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("choix_not_configurable");
	}
	return $data;
}

/**
* Set choix_not_configurable - Choix non configurable
* @param boolean $choix_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setChoix_not_configurable ($choix_not_configurable) {
	$this->choix_not_configurable = $choix_not_configurable;
	return $this;
}

/**
* Get traitement_surface - Traitement de surface
* @return string
*/
public function getTraitement_surface () {
	$preValue = $this->preGetValue("traitement_surface"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->traitement_surface;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("traitement_surface")->isEmpty($data)) {
		return $this->getValueFromParent("traitement_surface");
	}
	return $data;
}

/**
* Set traitement_surface - Traitement de surface
* @param string $traitement_surface
* @return \Pimcore\Model\Object\Product
*/
public function setTraitement_surface ($traitement_surface) {
	$this->traitement_surface = $traitement_surface;
	return $this;
}

/**
* Get traitement_surface_not_configurable - Traitement de surface non configurable
* @return boolean
*/
public function getTraitement_surface_not_configurable () {
	$preValue = $this->preGetValue("traitement_surface_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->traitement_surface_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("traitement_surface_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("traitement_surface_not_configurable");
	}
	return $data;
}

/**
* Set traitement_surface_not_configurable - Traitement de surface non configurable
* @param boolean $traitement_surface_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setTraitement_surface_not_configurable ($traitement_surface_not_configurable) {
	$this->traitement_surface_not_configurable = $traitement_surface_not_configurable;
	return $this;
}

/**
* Get finition - Finition
* @return string
*/
public function getFinition () {
	$preValue = $this->preGetValue("finition"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->finition;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("finition")->isEmpty($data)) {
		return $this->getValueFromParent("finition");
	}
	return $data;
}

/**
* Set finition - Finition
* @param string $finition
* @return \Pimcore\Model\Object\Product
*/
public function setFinition ($finition) {
	$this->finition = $finition;
	return $this;
}

/**
* Get finition_not_configurable - Finition non configurable
* @return boolean
*/
public function getFinition_not_configurable () {
	$preValue = $this->preGetValue("finition_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->finition_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("finition_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("finition_not_configurable");
	}
	return $data;
}

/**
* Set finition_not_configurable - Finition non configurable
* @param boolean $finition_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setFinition_not_configurable ($finition_not_configurable) {
	$this->finition_not_configurable = $finition_not_configurable;
	return $this;
}

/**
* Get motif - Motif
* @return string
*/
public function getMotif () {
	$preValue = $this->preGetValue("motif"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->motif;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("motif")->isEmpty($data)) {
		return $this->getValueFromParent("motif");
	}
	return $data;
}

/**
* Set motif - Motif
* @param string $motif
* @return \Pimcore\Model\Object\Product
*/
public function setMotif ($motif) {
	$this->motif = $motif;
	return $this;
}

/**
* Get fixation - Fixation
* @return array
*/
public function getFixation () {
	$preValue = $this->preGetValue("fixation"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->fixation;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fixation")->isEmpty($data)) {
		return $this->getValueFromParent("fixation");
	}
	return $data;
}

/**
* Set fixation - Fixation
* @param array $fixation
* @return \Pimcore\Model\Object\Product
*/
public function setFixation ($fixation) {
	$this->fixation = $fixation;
	return $this;
}

/**
* Get fixation_not_configurable - Fixation non configurable
* @return boolean
*/
public function getFixation_not_configurable () {
	$preValue = $this->preGetValue("fixation_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->fixation_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fixation_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("fixation_not_configurable");
	}
	return $data;
}

/**
* Set fixation_not_configurable - Fixation non configurable
* @param boolean $fixation_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setFixation_not_configurable ($fixation_not_configurable) {
	$this->fixation_not_configurable = $fixation_not_configurable;
	return $this;
}

/**
* Get pose - Pose
* @return array
*/
public function getPose () {
	$preValue = $this->preGetValue("pose"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pose;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pose")->isEmpty($data)) {
		return $this->getValueFromParent("pose");
	}
	return $data;
}

/**
* Set pose - Pose
* @param array $pose
* @return \Pimcore\Model\Object\Product
*/
public function setPose ($pose) {
	$this->pose = $pose;
	return $this;
}

/**
* Get epaisseur - Epaisseur
* @return string
*/
public function getEpaisseur () {
	$preValue = $this->preGetValue("epaisseur"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseur;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseur")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseur");
	}
	return $data;
}

/**
* Set epaisseur - Epaisseur
* @param string $epaisseur
* @return \Pimcore\Model\Object\Product
*/
public function setEpaisseur ($epaisseur) {
	$this->epaisseur = $epaisseur;
	return $this;
}

/**
* Get epaisseur_txt - Epaisseur Text
* @return string
*/
public function getEpaisseur_txt () {
	$preValue = $this->preGetValue("epaisseur_txt"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseur_txt;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseur_txt")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseur_txt");
	}
	return $data;
}

/**
* Set epaisseur_txt - Epaisseur Text
* @param string $epaisseur_txt
* @return \Pimcore\Model\Object\Product
*/
public function setEpaisseur_txt ($epaisseur_txt) {
	$this->epaisseur_txt = $epaisseur_txt;
	return $this;
}

/**
* Get epaisseur_not_configurable - Epaisseur non configurable
* @return boolean
*/
public function getEpaisseur_not_configurable () {
	$preValue = $this->preGetValue("epaisseur_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->epaisseur_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("epaisseur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("epaisseur_not_configurable");
	}
	return $data;
}

/**
* Set epaisseur_not_configurable - Epaisseur non configurable
* @param boolean $epaisseur_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setEpaisseur_not_configurable ($epaisseur_not_configurable) {
	$this->epaisseur_not_configurable = $epaisseur_not_configurable;
	return $this;
}

/**
* Get largeur - Largeur
* @return string
*/
public function getLargeur () {
	$preValue = $this->preGetValue("largeur"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur")->isEmpty($data)) {
		return $this->getValueFromParent("largeur");
	}
	return $data;
}

/**
* Set largeur - Largeur
* @param string $largeur
* @return \Pimcore\Model\Object\Product
*/
public function setLargeur ($largeur) {
	$this->largeur = $largeur;
	return $this;
}

/**
* Get largeur_txt - Largeur Text
* @return string
*/
public function getLargeur_txt () {
	$preValue = $this->preGetValue("largeur_txt"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur_txt;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur_txt")->isEmpty($data)) {
		return $this->getValueFromParent("largeur_txt");
	}
	return $data;
}

/**
* Set largeur_txt - Largeur Text
* @param string $largeur_txt
* @return \Pimcore\Model\Object\Product
*/
public function setLargeur_txt ($largeur_txt) {
	$this->largeur_txt = $largeur_txt;
	return $this;
}

/**
* Get largeur_type - Type de  largeur
* @return string
*/
public function getLargeur_type () {
	$preValue = $this->preGetValue("largeur_type"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur_type;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur_type")->isEmpty($data)) {
		return $this->getValueFromParent("largeur_type");
	}
	return $data;
}

/**
* Set largeur_type - Type de  largeur
* @param string $largeur_type
* @return \Pimcore\Model\Object\Product
*/
public function setLargeur_type ($largeur_type) {
	$this->largeur_type = $largeur_type;
	return $this;
}

/**
* Get largeur_colis - Largeur du colis
* @return string
*/
public function getLargeur_colis () {
	$preValue = $this->preGetValue("largeur_colis"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur_colis;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur_colis")->isEmpty($data)) {
		return $this->getValueFromParent("largeur_colis");
	}
	return $data;
}

/**
* Set largeur_colis - Largeur du colis
* @param string $largeur_colis
* @return \Pimcore\Model\Object\Product
*/
public function setLargeur_colis ($largeur_colis) {
	$this->largeur_colis = $largeur_colis;
	return $this;
}

/**
* Get largeur_not_configurable - Largeur non configurable
* @return boolean
*/
public function getLargeur_not_configurable () {
	$preValue = $this->preGetValue("largeur_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->largeur_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("largeur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("largeur_not_configurable");
	}
	return $data;
}

/**
* Set largeur_not_configurable - Largeur non configurable
* @param boolean $largeur_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setLargeur_not_configurable ($largeur_not_configurable) {
	$this->largeur_not_configurable = $largeur_not_configurable;
	return $this;
}

/**
* Get longueur - Longueur
* @return string
*/
public function getLongueur () {
	$preValue = $this->preGetValue("longueur"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur")->isEmpty($data)) {
		return $this->getValueFromParent("longueur");
	}
	return $data;
}

/**
* Set longueur - Longueur
* @param string $longueur
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur ($longueur) {
	$this->longueur = $longueur;
	return $this;
}

/**
* Get longueur_txt - Longueur Text
* @return string
*/
public function getLongueur_txt () {
	$preValue = $this->preGetValue("longueur_txt"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_txt;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_txt")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_txt");
	}
	return $data;
}

/**
* Set longueur_txt - Longueur Text
* @param string $longueur_txt
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur_txt ($longueur_txt) {
	$this->longueur_txt = $longueur_txt;
	return $this;
}

/**
* Get longueur_min - Longueur Min
* @return string
*/
public function getLongueur_min () {
	$preValue = $this->preGetValue("longueur_min"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_min;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_min")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_min");
	}
	return $data;
}

/**
* Set longueur_min - Longueur Min
* @param string $longueur_min
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur_min ($longueur_min) {
	$this->longueur_min = $longueur_min;
	return $this;
}

/**
* Get longueur_max - Longueur Max
* @return string
*/
public function getLongueur_max () {
	$preValue = $this->preGetValue("longueur_max"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_max;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_max")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_max");
	}
	return $data;
}

/**
* Set longueur_max - Longueur Max
* @param string $longueur_max
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur_max ($longueur_max) {
	$this->longueur_max = $longueur_max;
	return $this;
}

/**
* Get longueur_colis - Longueur du colis
* @return string
*/
public function getLongueur_colis () {
	$preValue = $this->preGetValue("longueur_colis"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_colis;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_colis")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_colis");
	}
	return $data;
}

/**
* Set longueur_colis - Longueur du colis
* @param string $longueur_colis
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur_colis ($longueur_colis) {
	$this->longueur_colis = $longueur_colis;
	return $this;
}

/**
* Get longueur_not_configurable - Longueur non configurable
* @return boolean
*/
public function getLongueur_not_configurable () {
	$preValue = $this->preGetValue("longueur_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->longueur_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("longueur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("longueur_not_configurable");
	}
	return $data;
}

/**
* Set longueur_not_configurable - Longueur non configurable
* @param boolean $longueur_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setLongueur_not_configurable ($longueur_not_configurable) {
	$this->longueur_not_configurable = $longueur_not_configurable;
	return $this;
}

/**
* Get mage_section - Section
* @return string
*/
public function getMage_section () {
	$preValue = $this->preGetValue("mage_section"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_section;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_section")->isEmpty($data)) {
		return $this->getValueFromParent("mage_section");
	}
	return $data;
}

/**
* Set mage_section - Section
* @param string $mage_section
* @return \Pimcore\Model\Object\Product
*/
public function setMage_section ($mage_section) {
	$this->mage_section = $mage_section;
	return $this;
}

/**
* Get pimonly_section - Section générées
* @return string
*/
public function getPimonly_section () {
	$preValue = $this->preGetValue("pimonly_section"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pimonly_section;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_section")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_section");
	}
	return $data;
}

/**
* Set pimonly_section - Section générées
* @param string $pimonly_section
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_section ($pimonly_section) {
	$this->pimonly_section = $pimonly_section;
	return $this;
}

/**
* Get mage_use_section_as_configurable - Section Configurable?
* @return boolean
*/
public function getMage_use_section_as_configurable () {
	$preValue = $this->preGetValue("mage_use_section_as_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_use_section_as_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_use_section_as_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("mage_use_section_as_configurable");
	}
	return $data;
}

/**
* Set mage_use_section_as_configurable - Section Configurable?
* @param boolean $mage_use_section_as_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setMage_use_section_as_configurable ($mage_use_section_as_configurable) {
	$this->mage_use_section_as_configurable = $mage_use_section_as_configurable;
	return $this;
}

/**
* Get hauteur - Hauteur / Rattrapage
* @return string
*/
public function getHauteur () {
	$preValue = $this->preGetValue("hauteur"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hauteur;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hauteur")->isEmpty($data)) {
		return $this->getValueFromParent("hauteur");
	}
	return $data;
}

/**
* Set hauteur - Hauteur / Rattrapage
* @param string $hauteur
* @return \Pimcore\Model\Object\Product
*/
public function setHauteur ($hauteur) {
	$this->hauteur = $hauteur;
	return $this;
}

/**
* Get hauteur_colis - Hauteur du colis
* @return string
*/
public function getHauteur_colis () {
	$preValue = $this->preGetValue("hauteur_colis"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hauteur_colis;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hauteur_colis")->isEmpty($data)) {
		return $this->getValueFromParent("hauteur_colis");
	}
	return $data;
}

/**
* Set hauteur_colis - Hauteur du colis
* @param string $hauteur_colis
* @return \Pimcore\Model\Object\Product
*/
public function setHauteur_colis ($hauteur_colis) {
	$this->hauteur_colis = $hauteur_colis;
	return $this;
}

/**
* Get hauteur_not_configurable - Hauteur non configurable
* @return boolean
*/
public function getHauteur_not_configurable () {
	$preValue = $this->preGetValue("hauteur_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->hauteur_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("hauteur_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("hauteur_not_configurable");
	}
	return $data;
}

/**
* Set hauteur_not_configurable - Hauteur non configurable
* @param boolean $hauteur_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setHauteur_not_configurable ($hauteur_not_configurable) {
	$this->hauteur_not_configurable = $hauteur_not_configurable;
	return $this;
}

/**
* Get color - Couleur / Teinte
* @return string
*/
public function getColor () {
	$preValue = $this->preGetValue("color"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->color;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("color")->isEmpty($data)) {
		return $this->getValueFromParent("color");
	}
	return $data;
}

/**
* Set color - Couleur / Teinte
* @param string $color
* @return \Pimcore\Model\Object\Product
*/
public function setColor ($color) {
	$this->color = $color;
	return $this;
}

/**
* Get color_not_configurable - Couleur non configurable
* @return boolean
*/
public function getColor_not_configurable () {
	$preValue = $this->preGetValue("color_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->color_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("color_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("color_not_configurable");
	}
	return $data;
}

/**
* Set color_not_configurable - Couleur non configurable
* @param boolean $color_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setColor_not_configurable ($color_not_configurable) {
	$this->color_not_configurable = $color_not_configurable;
	return $this;
}

/**
* Get volume - Volume
* @return string
*/
public function getVolume () {
	$preValue = $this->preGetValue("volume"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->volume;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("volume")->isEmpty($data)) {
		return $this->getValueFromParent("volume");
	}
	return $data;
}

/**
* Set volume - Volume
* @param string $volume
* @return \Pimcore\Model\Object\Product
*/
public function setVolume ($volume) {
	$this->volume = $volume;
	return $this;
}

/**
* Get volume_not_configurable - Volume non configurable
* @return boolean
*/
public function getVolume_not_configurable () {
	$preValue = $this->preGetValue("volume_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->volume_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("volume_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("volume_not_configurable");
	}
	return $data;
}

/**
* Set volume_not_configurable - Volume non configurable
* @param boolean $volume_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setVolume_not_configurable ($volume_not_configurable) {
	$this->volume_not_configurable = $volume_not_configurable;
	return $this;
}

/**
* Get conditionnement - Conditionnement
* @return string
*/
public function getConditionnement () {
	$preValue = $this->preGetValue("conditionnement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->conditionnement;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("conditionnement")->isEmpty($data)) {
		return $this->getValueFromParent("conditionnement");
	}
	return $data;
}

/**
* Set conditionnement - Conditionnement
* @param string $conditionnement
* @return \Pimcore\Model\Object\Product
*/
public function setConditionnement ($conditionnement) {
	$this->conditionnement = $conditionnement;
	return $this;
}

/**
* Get conditionnement_not_configurable - Conditionnement non configurable
* @return boolean
*/
public function getConditionnement_not_configurable () {
	$preValue = $this->preGetValue("conditionnement_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->conditionnement_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("conditionnement_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("conditionnement_not_configurable");
	}
	return $data;
}

/**
* Set conditionnement_not_configurable - Conditionnement non configurable
* @param boolean $conditionnement_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setConditionnement_not_configurable ($conditionnement_not_configurable) {
	$this->conditionnement_not_configurable = $conditionnement_not_configurable;
	return $this;
}

/**
* Get chanfreins - Chanfreins
* @return string
*/
public function getChanfreins () {
	$preValue = $this->preGetValue("chanfreins"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->chanfreins;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("chanfreins")->isEmpty($data)) {
		return $this->getValueFromParent("chanfreins");
	}
	return $data;
}

/**
* Set chanfreins - Chanfreins
* @param string $chanfreins
* @return \Pimcore\Model\Object\Product
*/
public function setChanfreins ($chanfreins) {
	$this->chanfreins = $chanfreins;
	return $this;
}

/**
* Get mage_use_chanfreins_as_configurable - Chanfreins configurables ?
* @return boolean
*/
public function getMage_use_chanfreins_as_configurable () {
	$preValue = $this->preGetValue("mage_use_chanfreins_as_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_use_chanfreins_as_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_use_chanfreins_as_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("mage_use_chanfreins_as_configurable");
	}
	return $data;
}

/**
* Set mage_use_chanfreins_as_configurable - Chanfreins configurables ?
* @param boolean $mage_use_chanfreins_as_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setMage_use_chanfreins_as_configurable ($mage_use_chanfreins_as_configurable) {
	$this->mage_use_chanfreins_as_configurable = $mage_use_chanfreins_as_configurable;
	return $this;
}

/**
* Get profil - Profil
* @return array
*/
public function getProfil () {
	$preValue = $this->preGetValue("profil"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->profil;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("profil")->isEmpty($data)) {
		return $this->getValueFromParent("profil");
	}
	return $data;
}

/**
* Set profil - Profil
* @param array $profil
* @return \Pimcore\Model\Object\Product
*/
public function setProfil ($profil) {
	$this->profil = $profil;
	return $this;
}

/**
* Get profil_not_configurable - Profil non configurable
* @return boolean
*/
public function getProfil_not_configurable () {
	$preValue = $this->preGetValue("profil_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->profil_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("profil_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("profil_not_configurable");
	}
	return $data;
}

/**
* Set profil_not_configurable - Profil non configurable
* @param boolean $profil_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setProfil_not_configurable ($profil_not_configurable) {
	$this->profil_not_configurable = $profil_not_configurable;
	return $this;
}

/**
* Get configurable_free_1 - Option configurable
* @return string
*/
public function getConfigurable_free_1 () {
	$preValue = $this->preGetValue("configurable_free_1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->configurable_free_1;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("configurable_free_1")->isEmpty($data)) {
		return $this->getValueFromParent("configurable_free_1");
	}
	return $data;
}

/**
* Set configurable_free_1 - Option configurable
* @param string $configurable_free_1
* @return \Pimcore\Model\Object\Product
*/
public function setConfigurable_free_1 ($configurable_free_1) {
	$this->configurable_free_1 = $configurable_free_1;
	return $this;
}

/**
* Get configurable_free_2 - Configurable libre 2
* @return string
*/
public function getConfigurable_free_2 () {
	$preValue = $this->preGetValue("configurable_free_2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->configurable_free_2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("configurable_free_2")->isEmpty($data)) {
		return $this->getValueFromParent("configurable_free_2");
	}
	return $data;
}

/**
* Set configurable_free_2 - Configurable libre 2
* @param string $configurable_free_2
* @return \Pimcore\Model\Object\Product
*/
public function setConfigurable_free_2 ($configurable_free_2) {
	$this->configurable_free_2 = $configurable_free_2;
	return $this;
}

/**
* Get quantity_min - Quantité Minimum à commander (par rapport à l'unité colisage)
* @return string
*/
public function getQuantity_min () {
	$preValue = $this->preGetValue("quantity_min"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->quantity_min;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("quantity_min")->isEmpty($data)) {
		return $this->getValueFromParent("quantity_min");
	}
	return $data;
}

/**
* Set quantity_min - Quantité Minimum à commander (par rapport à l'unité colisage)
* @param string $quantity_min
* @return \Pimcore\Model\Object\Product
*/
public function setQuantity_min ($quantity_min) {
	$this->quantity_min = $quantity_min;
	return $this;
}

/**
* Get quantity_max - Quantité Maximum à commander (par rapport à l'unité colisage)
* @return string
*/
public function getQuantity_max () {
	$preValue = $this->preGetValue("quantity_max"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->quantity_max;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("quantity_max")->isEmpty($data)) {
		return $this->getValueFromParent("quantity_max");
	}
	return $data;
}

/**
* Set quantity_max - Quantité Maximum à commander (par rapport à l'unité colisage)
* @param string $quantity_max
* @return \Pimcore\Model\Object\Product
*/
public function setQuantity_max ($quantity_max) {
	$this->quantity_max = $quantity_max;
	return $this;
}

/**
* Get quantity_min_txt - Quantité Minimum à commander (txt)
* @return string
*/
public function getQuantity_min_txt () {
	$preValue = $this->preGetValue("quantity_min_txt"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->quantity_min_txt;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("quantity_min_txt")->isEmpty($data)) {
		return $this->getValueFromParent("quantity_min_txt");
	}
	return $data;
}

/**
* Set quantity_min_txt - Quantité Minimum à commander (txt)
* @param string $quantity_min_txt
* @return \Pimcore\Model\Object\Product
*/
public function setQuantity_min_txt ($quantity_min_txt) {
	$this->quantity_min_txt = $quantity_min_txt;
	return $this;
}

/**
* Get quantity_min_txt_not_configurable - min_quantity_not_configurable
* @return boolean
*/
public function getQuantity_min_txt_not_configurable () {
	$preValue = $this->preGetValue("quantity_min_txt_not_configurable"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->quantity_min_txt_not_configurable;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("quantity_min_txt_not_configurable")->isEmpty($data)) {
		return $this->getValueFromParent("quantity_min_txt_not_configurable");
	}
	return $data;
}

/**
* Set quantity_min_txt_not_configurable - min_quantity_not_configurable
* @param boolean $quantity_min_txt_not_configurable
* @return \Pimcore\Model\Object\Product
*/
public function setQuantity_min_txt_not_configurable ($quantity_min_txt_not_configurable) {
	$this->quantity_min_txt_not_configurable = $quantity_min_txt_not_configurable;
	return $this;
}

/**
* Get characteristics_others - Caractéristiques Autre
* @return string
*/
public function getCharacteristics_others () {
	$preValue = $this->preGetValue("characteristics_others"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics_others;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics_others")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics_others");
	}
	return $data;
}

/**
* Set characteristics_others - Caractéristiques Autre
* @param string $characteristics_others
* @return \Pimcore\Model\Object\Product
*/
public function setCharacteristics_others ($characteristics_others) {
	$this->characteristics_others = $characteristics_others;
	return $this;
}

/**
* Get characteristics_others_tech - Caractéristiques Autre Technique
* @return string
*/
public function getCharacteristics_others_tech () {
	$preValue = $this->preGetValue("characteristics_others_tech"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics_others_tech;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics_others_tech")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics_others_tech");
	}
	return $data;
}

/**
* Set characteristics_others_tech - Caractéristiques Autre Technique
* @param string $characteristics_others_tech
* @return \Pimcore\Model\Object\Product
*/
public function setCharacteristics_others_tech ($characteristics_others_tech) {
	$this->characteristics_others_tech = $characteristics_others_tech;
	return $this;
}

/**
* Get characteristics_others_perf - Caractéristiques Autre Performance
* @return string
*/
public function getCharacteristics_others_perf () {
	$preValue = $this->preGetValue("characteristics_others_perf"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics_others_perf;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics_others_perf")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics_others_perf");
	}
	return $data;
}

/**
* Set characteristics_others_perf - Caractéristiques Autre Performance
* @param string $characteristics_others_perf
* @return \Pimcore\Model\Object\Product
*/
public function setCharacteristics_others_perf ($characteristics_others_perf) {
	$this->characteristics_others_perf = $characteristics_others_perf;
	return $this;
}

/**
* Get unite - Unité
* @return string
*/
public function getUnite () {
	$preValue = $this->preGetValue("unite"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->unite;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("unite")->isEmpty($data)) {
		return $this->getValueFromParent("unite");
	}
	return $data;
}

/**
* Set unite - Unité
* @param string $unite
* @return \Pimcore\Model\Object\Product
*/
public function setUnite ($unite) {
	$this->unite = $unite;
	return $this;
}

/**
* Get weight - Poids de base (en kg)
* @return string
*/
public function getWeight () {
	$preValue = $this->preGetValue("weight"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->weight;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("weight")->isEmpty($data)) {
		return $this->getValueFromParent("weight");
	}
	return $data;
}

/**
* Set weight - Poids de base (en kg)
* @param string $weight
* @return \Pimcore\Model\Object\Product
*/
public function setWeight ($weight) {
	$this->weight = $weight;
	return $this;
}

/**
* Get mode_calcul - Mode de caclul
* @return string
*/
public function getMode_calcul () {
	$preValue = $this->preGetValue("mode_calcul"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mode_calcul;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mode_calcul")->isEmpty($data)) {
		return $this->getValueFromParent("mode_calcul");
	}
	return $data;
}

/**
* Set mode_calcul - Mode de caclul
* @param string $mode_calcul
* @return \Pimcore\Model\Object\Product
*/
public function setMode_calcul ($mode_calcul) {
	$this->mode_calcul = $mode_calcul;
	return $this;
}

/**
* Get rendement - Rendement
* @return string
*/
public function getRendement () {
	$preValue = $this->preGetValue("rendement"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->rendement;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("rendement")->isEmpty($data)) {
		return $this->getValueFromParent("rendement");
	}
	return $data;
}

/**
* Set rendement - Rendement
* @param string $rendement
* @return \Pimcore\Model\Object\Product
*/
public function setRendement ($rendement) {
	$this->rendement = $rendement;
	return $this;
}

/**
* Get famille - Famille Article
* @return string
*/
public function getFamille () {
	$preValue = $this->preGetValue("famille"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->famille;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("famille")->isEmpty($data)) {
		return $this->getValueFromParent("famille");
	}
	return $data;
}

/**
* Set famille - Famille Article
* @param string $famille
* @return \Pimcore\Model\Object\Product
*/
public function setFamille ($famille) {
	$this->famille = $famille;
	return $this;
}

/**
* Get classe_service - Classe de service
* @return string
*/
public function getClasse_service () {
	$preValue = $this->preGetValue("classe_service"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->classe_service;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("classe_service")->isEmpty($data)) {
		return $this->getValueFromParent("classe_service");
	}
	return $data;
}

/**
* Set classe_service - Classe de service
* @param string $classe_service
* @return \Pimcore\Model\Object\Product
*/
public function setClasse_service ($classe_service) {
	$this->classe_service = $classe_service;
	return $this;
}

/**
* Get origine_bois - Origine du Bois
* @return string
*/
public function getOrigine_bois () {
	$preValue = $this->preGetValue("origine_bois"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->origine_bois;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("origine_bois")->isEmpty($data)) {
		return $this->getValueFromParent("origine_bois");
	}
	return $data;
}

/**
* Set origine_bois - Origine du Bois
* @param string $origine_bois
* @return \Pimcore\Model\Object\Product
*/
public function setOrigine_bois ($origine_bois) {
	$this->origine_bois = $origine_bois;
	return $this;
}

/**
* Get country_of_manufacture - Pays de Fabrication
* @return string
*/
public function getCountry_of_manufacture () {
	$preValue = $this->preGetValue("country_of_manufacture"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->country_of_manufacture;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("country_of_manufacture")->isEmpty($data)) {
		return $this->getValueFromParent("country_of_manufacture");
	}
	return $data;
}

/**
* Set country_of_manufacture - Pays de Fabrication
* @param string $country_of_manufacture
* @return \Pimcore\Model\Object\Product
*/
public function setCountry_of_manufacture ($country_of_manufacture) {
	$this->country_of_manufacture = $country_of_manufacture;
	return $this;
}

/**
* Get colisage - Colisage
* @return string
*/
public function getColisage () {
	$preValue = $this->preGetValue("colisage"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->colisage;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("colisage")->isEmpty($data)) {
		return $this->getValueFromParent("colisage");
	}
	return $data;
}

/**
* Set colisage - Colisage
* @param string $colisage
* @return \Pimcore\Model\Object\Product
*/
public function setColisage ($colisage) {
	$this->colisage = $colisage;
	return $this;
}

/**
* Get surface - Surface du lot
* @return string
*/
public function getSurface () {
	$preValue = $this->preGetValue("surface"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->surface;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("surface")->isEmpty($data)) {
		return $this->getValueFromParent("surface");
	}
	return $data;
}

/**
* Set surface - Surface du lot
* @param string $surface
* @return \Pimcore\Model\Object\Product
*/
public function setSurface ($surface) {
	$this->surface = $surface;
	return $this;
}

/**
* Get typeLame - Type de lame
* @return string
*/
public function getTypeLame () {
	$preValue = $this->preGetValue("typeLame"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->typeLame;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("typeLame")->isEmpty($data)) {
		return $this->getValueFromParent("typeLame");
	}
	return $data;
}

/**
* Set typeLame - Type de lame
* @param string $typeLame
* @return \Pimcore\Model\Object\Product
*/
public function setTypeLame ($typeLame) {
	$this->typeLame = $typeLame;
	return $this;
}

/**
* Get angle - Angle
* @return string
*/
public function getAngle () {
	$preValue = $this->preGetValue("angle"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->angle;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("angle")->isEmpty($data)) {
		return $this->getValueFromParent("angle");
	}
	return $data;
}

/**
* Set angle - Angle
* @param string $angle
* @return \Pimcore\Model\Object\Product
*/
public function setAngle ($angle) {
	$this->angle = $angle;
	return $this;
}

/**
* Get is_lot - Est un lot ?
* @return string
*/
public function getIs_lot () {
	$preValue = $this->preGetValue("is_lot"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->is_lot;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("is_lot")->isEmpty($data)) {
		return $this->getValueFromParent("is_lot");
	}
	return $data;
}

/**
* Set is_lot - Est un lot ?
* @param string $is_lot
* @return \Pimcore\Model\Object\Product
*/
public function setIs_lot ($is_lot) {
	$this->is_lot = $is_lot;
	return $this;
}

/**
* Get pieceHumide - Compatible pièces humides
* @return string
*/
public function getPieceHumide () {
	$preValue = $this->preGetValue("pieceHumide"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pieceHumide;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pieceHumide")->isEmpty($data)) {
		return $this->getValueFromParent("pieceHumide");
	}
	return $data;
}

/**
* Set pieceHumide - Compatible pièces humides
* @param string $pieceHumide
* @return \Pimcore\Model\Object\Product
*/
public function setPieceHumide ($pieceHumide) {
	$this->pieceHumide = $pieceHumide;
	return $this;
}

/**
* Get sousCoucheIntegree - Sous-couche intégrée
* @return boolean
*/
public function getSousCoucheIntegree () {
	$preValue = $this->preGetValue("sousCoucheIntegree"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->sousCoucheIntegree;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("sousCoucheIntegree")->isEmpty($data)) {
		return $this->getValueFromParent("sousCoucheIntegree");
	}
	return $data;
}

/**
* Set sousCoucheIntegree - Sous-couche intégrée
* @param boolean $sousCoucheIntegree
* @return \Pimcore\Model\Object\Product
*/
public function setSousCoucheIntegree ($sousCoucheIntegree) {
	$this->sousCoucheIntegree = $sousCoucheIntegree;
	return $this;
}

/**
* Get pefc - Pefc
* @return boolean
*/
public function getPefc () {
	$preValue = $this->preGetValue("pefc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->pefc;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pefc")->isEmpty($data)) {
		return $this->getValueFromParent("pefc");
	}
	return $data;
}

/**
* Set pefc - Pefc
* @param boolean $pefc
* @return \Pimcore\Model\Object\Product
*/
public function setPefc ($pefc) {
	$this->pefc = $pefc;
	return $this;
}

/**
* Get fsc - FSC
* @return boolean
*/
public function getFsc () {
	$preValue = $this->preGetValue("fsc"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->fsc;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fsc")->isEmpty($data)) {
		return $this->getValueFromParent("fsc");
	}
	return $data;
}

/**
* Set fsc - FSC
* @param boolean $fsc
* @return \Pimcore\Model\Object\Product
*/
public function setFsc ($fsc) {
	$this->fsc = $fsc;
	return $this;
}

/**
* Get parquet_de_france - Parquet de France
* @return boolean
*/
public function getParquet_de_france () {
	$preValue = $this->preGetValue("parquet_de_france"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->parquet_de_france;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("parquet_de_france")->isEmpty($data)) {
		return $this->getValueFromParent("parquet_de_france");
	}
	return $data;
}

/**
* Set parquet_de_france - Parquet de France
* @param boolean $parquet_de_france
* @return \Pimcore\Model\Object\Product
*/
public function setParquet_de_france ($parquet_de_france) {
	$this->parquet_de_france = $parquet_de_france;
	return $this;
}

/**
* Get nf - NF
* @return boolean
*/
public function getNf () {
	$preValue = $this->preGetValue("nf"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->nf;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("nf")->isEmpty($data)) {
		return $this->getValueFromParent("nf");
	}
	return $data;
}

/**
* Set nf - NF
* @param boolean $nf
* @return \Pimcore\Model\Object\Product
*/
public function setNf ($nf) {
	$this->nf = $nf;
	return $this;
}

/**
* Get nbrpp - NBRPP
* @return string
*/
public function getNbrpp () {
	$preValue = $this->preGetValue("nbrpp"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->nbrpp;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("nbrpp")->isEmpty($data)) {
		return $this->getValueFromParent("nbrpp");
	}
	return $data;
}

/**
* Set nbrpp - NBRPP
* @param string $nbrpp
* @return \Pimcore\Model\Object\Product
*/
public function setNbrpp ($nbrpp) {
	$this->nbrpp = $nbrpp;
	return $this;
}

/**
* Get qualite - Qualité
* @return string
*/
public function getQualite () {
	$preValue = $this->preGetValue("qualite"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->qualite;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("qualite")->isEmpty($data)) {
		return $this->getValueFromParent("qualite");
	}
	return $data;
}

/**
* Set qualite - Qualité
* @param string $qualite
* @return \Pimcore\Model\Object\Product
*/
public function setQualite ($qualite) {
	$this->qualite = $qualite;
	return $this;
}

/**
* Get extras - Autre
* @return \Pimcore\Model\Object\productExtra[]
*/
public function getExtras () {
	$preValue = $this->preGetValue("extras"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("extras")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("extras")->isEmpty($data)) {
		return $this->getValueFromParent("extras");
	}
	return $data;
}

/**
* Set extras - Autre
* @param \Pimcore\Model\Object\productExtra[] $extras
* @return \Pimcore\Model\Object\Product
*/
public function setExtras ($extras) {
	$this->extras = $this->getClass()->getFieldDefinition("extras")->preSetData($this, $extras);
	return $this;
}

/**
* Get realisations - Réalisations (Gallery)
* @return \Pimcore\Model\Asset\folder[]
*/
public function getRealisations () {
	$preValue = $this->preGetValue("realisations"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("realisations")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("realisations")->isEmpty($data)) {
		return $this->getValueFromParent("realisations");
	}
	return $data;
}

/**
* Set realisations - Réalisations (Gallery)
* @param \Pimcore\Model\Asset\folder[] $realisations
* @return \Pimcore\Model\Object\Product
*/
public function setRealisations ($realisations) {
	$this->realisations = $this->getClass()->getFieldDefinition("realisations")->preSetData($this, $realisations);
	return $this;
}

/**
* Get fiche_technique_lpn - Fiche technique LPN
* @return \Pimcore\Model\Asset\archive | \Pimcore\Model\Asset\document
*/
public function getFiche_technique_lpn () {
	$preValue = $this->preGetValue("fiche_technique_lpn"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_technique_lpn")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_technique_lpn");
	}
	return $data;
}

/**
* Set fiche_technique_lpn - Fiche technique LPN
* @param \Pimcore\Model\Asset\archive | \Pimcore\Model\Asset\document $fiche_technique_lpn
* @return \Pimcore\Model\Object\Product
*/
public function setFiche_technique_lpn ($fiche_technique_lpn) {
	$this->fiche_technique_lpn = $this->getClass()->getFieldDefinition("fiche_technique_lpn")->preSetData($this, $fiche_technique_lpn);
	return $this;
}

/**
* Get fiche_technique_orginale - Fiche technique originale
* @return \Pimcore\Model\Asset
*/
public function getFiche_technique_orginale () {
	$preValue = $this->preGetValue("fiche_technique_orginale"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_technique_orginale")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_technique_orginale");
	}
	return $data;
}

/**
* Set fiche_technique_orginale - Fiche technique originale
* @param \Pimcore\Model\Asset $fiche_technique_orginale
* @return \Pimcore\Model\Object\Product
*/
public function setFiche_technique_orginale ($fiche_technique_orginale) {
	$this->fiche_technique_orginale = $this->getClass()->getFieldDefinition("fiche_technique_orginale")->preSetData($this, $fiche_technique_orginale);
	return $this;
}

/**
* Get notice_pose_lpn - Notice de pose
* @return \Pimcore\Model\Document\page | \Pimcore\Model\Asset
*/
public function getNotice_pose_lpn () {
	$preValue = $this->preGetValue("notice_pose_lpn"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("notice_pose_lpn")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("notice_pose_lpn")->isEmpty($data)) {
		return $this->getValueFromParent("notice_pose_lpn");
	}
	return $data;
}

/**
* Set notice_pose_lpn - Notice de pose
* @param \Pimcore\Model\Document\page | \Pimcore\Model\Asset $notice_pose_lpn
* @return \Pimcore\Model\Object\Product
*/
public function setNotice_pose_lpn ($notice_pose_lpn) {
	$this->notice_pose_lpn = $this->getClass()->getFieldDefinition("notice_pose_lpn")->preSetData($this, $notice_pose_lpn);
	return $this;
}

/**
* Get fiche_securite - Fiche de sécurité
* @return \Pimcore\Model\Asset
*/
public function getFiche_securite () {
	$preValue = $this->preGetValue("fiche_securite"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_securite")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_securite")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_securite");
	}
	return $data;
}

/**
* Set fiche_securite - Fiche de sécurité
* @param \Pimcore\Model\Asset $fiche_securite
* @return \Pimcore\Model\Object\Product
*/
public function setFiche_securite ($fiche_securite) {
	$this->fiche_securite = $this->getClass()->getFieldDefinition("fiche_securite")->preSetData($this, $fiche_securite);
	return $this;
}

/**
* Get fiche_entretien - Fiche d'entretien
* @return \Pimcore\Model\Document\page | \Pimcore\Model\Asset\document | \Pimcore\Model\Asset\image
*/
public function getFiche_entretien () {
	$preValue = $this->preGetValue("fiche_entretien"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_entretien")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_entretien")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_entretien");
	}
	return $data;
}

/**
* Set fiche_entretien - Fiche d'entretien
* @param \Pimcore\Model\Document\page | \Pimcore\Model\Asset\document | \Pimcore\Model\Asset\image $fiche_entretien
* @return \Pimcore\Model\Object\Product
*/
public function setFiche_entretien ($fiche_entretien) {
	$this->fiche_entretien = $this->getClass()->getFieldDefinition("fiche_entretien")->preSetData($this, $fiche_entretien);
	return $this;
}

/**
* Get fiche_pose - Fiche de pose
* @return \Pimcore\Model\Document\page | \Pimcore\Model\Asset\document | \Pimcore\Model\Asset\image
*/
public function getFiche_pose () {
	$preValue = $this->preGetValue("fiche_pose"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("fiche_pose")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("fiche_pose")->isEmpty($data)) {
		return $this->getValueFromParent("fiche_pose");
	}
	return $data;
}

/**
* Set fiche_pose - Fiche de pose
* @param \Pimcore\Model\Document\page | \Pimcore\Model\Asset\document | \Pimcore\Model\Asset\image $fiche_pose
* @return \Pimcore\Model\Object\Product
*/
public function setFiche_pose ($fiche_pose) {
	$this->fiche_pose = $this->getClass()->getFieldDefinition("fiche_pose")->preSetData($this, $fiche_pose);
	return $this;
}

/**
* Get re_skus - Produits associés
* @return \Pimcore\Model\Object\product[] | \Pimcore\Model\Object\category[]
*/
public function getRe_skus () {
	$preValue = $this->preGetValue("re_skus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("re_skus")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("re_skus")->isEmpty($data)) {
		return $this->getValueFromParent("re_skus");
	}
	return $data;
}

/**
* Set re_skus - Produits associés
* @param \Pimcore\Model\Object\product[] | \Pimcore\Model\Object\category[] $re_skus
* @return \Pimcore\Model\Object\Product
*/
public function setRe_skus ($re_skus) {
	$this->re_skus = $this->getClass()->getFieldDefinition("re_skus")->preSetData($this, $re_skus);
	return $this;
}

/**
* Get cs_skus - Crossels (tarif)
* @return \Pimcore\Model\Object\category[] | \Pimcore\Model\Object\product[]
*/
public function getCs_skus () {
	$preValue = $this->preGetValue("cs_skus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("cs_skus")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("cs_skus")->isEmpty($data)) {
		return $this->getValueFromParent("cs_skus");
	}
	return $data;
}

/**
* Set cs_skus - Crossels (tarif)
* @param \Pimcore\Model\Object\category[] | \Pimcore\Model\Object\product[] $cs_skus
* @return \Pimcore\Model\Object\Product
*/
public function setCs_skus ($cs_skus) {
	$this->cs_skus = $this->getClass()->getFieldDefinition("cs_skus")->preSetData($this, $cs_skus);
	return $this;
}

/**
* Get pimonly_category_pose - Catégorie Accessoire Pose
* @return \Pimcore\Model\Object\category
*/
public function getPimonly_category_pose () {
	$preValue = $this->preGetValue("pimonly_category_pose"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("pimonly_category_pose")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_category_pose")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_category_pose");
	}
	return $data;
}

/**
* Set pimonly_category_pose - Catégorie Accessoire Pose
* @param \Pimcore\Model\Object\category $pimonly_category_pose
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_category_pose ($pimonly_category_pose) {
	$this->pimonly_category_pose = $this->getClass()->getFieldDefinition("pimonly_category_pose")->preSetData($this, $pimonly_category_pose);
	return $this;
}

/**
* Get pimonly_category_finition - Catégorie Accessoire Finition
* @return \Pimcore\Model\Object\category
*/
public function getPimonly_category_finition () {
	$preValue = $this->preGetValue("pimonly_category_finition"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("pimonly_category_finition")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_category_finition")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_category_finition");
	}
	return $data;
}

/**
* Set pimonly_category_finition - Catégorie Accessoire Finition
* @param \Pimcore\Model\Object\category $pimonly_category_finition
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_category_finition ($pimonly_category_finition) {
	$this->pimonly_category_finition = $this->getClass()->getFieldDefinition("pimonly_category_finition")->preSetData($this, $pimonly_category_finition);
	return $this;
}

/**
* Get pimonly_category_entretien - Catégorie Accessoires Entretien
* @return \Pimcore\Model\Object\category
*/
public function getPimonly_category_entretien () {
	$preValue = $this->preGetValue("pimonly_category_entretien"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("pimonly_category_entretien")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("pimonly_category_entretien")->isEmpty($data)) {
		return $this->getValueFromParent("pimonly_category_entretien");
	}
	return $data;
}

/**
* Set pimonly_category_entretien - Catégorie Accessoires Entretien
* @param \Pimcore\Model\Object\category $pimonly_category_entretien
* @return \Pimcore\Model\Object\Product
*/
public function setPimonly_category_entretien ($pimonly_category_entretien) {
	$this->pimonly_category_entretien = $this->getClass()->getFieldDefinition("pimonly_category_entretien")->preSetData($this, $pimonly_category_entretien);
	return $this;
}

/**
* Get associatedArticles - Articles associés
* @return \Pimcore\Model\Object\article[]
*/
public function getAssociatedArticles () {
	$preValue = $this->preGetValue("associatedArticles"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("associatedArticles")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("associatedArticles")->isEmpty($data)) {
		return $this->getValueFromParent("associatedArticles");
	}
	return $data;
}

/**
* Set associatedArticles - Articles associés
* @param \Pimcore\Model\Object\article[] $associatedArticles
* @return \Pimcore\Model\Object\Product
*/
public function setAssociatedArticles ($associatedArticles) {
	$this->associatedArticles = $this->getClass()->getFieldDefinition("associatedArticles")->preSetData($this, $associatedArticles);
	return $this;
}

/**
* Get origineArticles - Articles associés (Origine)
* @return \Pimcore\Model\Object\article[]
*/
public function getOrigineArticles () {
	$preValue = $this->preGetValue("origineArticles"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("origineArticles")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("origineArticles")->isEmpty($data)) {
		return $this->getValueFromParent("origineArticles");
	}
	return $data;
}

/**
* Set origineArticles - Articles associés (Origine)
* @param \Pimcore\Model\Object\article[] $origineArticles
* @return \Pimcore\Model\Object\Product
*/
public function setOrigineArticles ($origineArticles) {
	$this->origineArticles = $this->getClass()->getFieldDefinition("origineArticles")->preSetData($this, $origineArticles);
	return $this;
}

/**
* Get meta_title - Métas Title
* @return string
*/
public function getMeta_title () {
	$preValue = $this->preGetValue("meta_title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_title;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_title")->isEmpty($data)) {
		return $this->getValueFromParent("meta_title");
	}
	return $data;
}

/**
* Set meta_title - Métas Title
* @param string $meta_title
* @return \Pimcore\Model\Object\Product
*/
public function setMeta_title ($meta_title) {
	$this->meta_title = $meta_title;
	return $this;
}

/**
* Get meta_title2 - meta_title2
* @return string
*/
public function getMeta_title2 () {
	$preValue = $this->preGetValue("meta_title2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_title2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_title2")->isEmpty($data)) {
		return $this->getValueFromParent("meta_title2");
	}
	return $data;
}

/**
* Set meta_title2 - meta_title2
* @param string $meta_title2
* @return \Pimcore\Model\Object\Product
*/
public function setMeta_title2 ($meta_title2) {
	$this->meta_title2 = $meta_title2;
	return $this;
}

/**
* Get meta_description - Meta Descriptions
* @return string
*/
public function getMeta_description () {
	$preValue = $this->preGetValue("meta_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_description")->isEmpty($data)) {
		return $this->getValueFromParent("meta_description");
	}
	return $data;
}

/**
* Set meta_description - Meta Descriptions
* @param string $meta_description
* @return \Pimcore\Model\Object\Product
*/
public function setMeta_description ($meta_description) {
	$this->meta_description = $meta_description;
	return $this;
}

/**
* Get meta_keywords - Meta Keywords
* @return string
*/
public function getMeta_keywords () {
	$preValue = $this->preGetValue("meta_keywords"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->meta_keywords;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("meta_keywords")->isEmpty($data)) {
		return $this->getValueFromParent("meta_keywords");
	}
	return $data;
}

/**
* Set meta_keywords - Meta Keywords
* @param string $meta_keywords
* @return \Pimcore\Model\Object\Product
*/
public function setMeta_keywords ($meta_keywords) {
	$this->meta_keywords = $meta_keywords;
	return $this;
}

/**
* Get price - Prix Public HT
* @return string
*/
public function getPrice () {
	$preValue = $this->preGetValue("price"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price")->isEmpty($data)) {
		return $this->getValueFromParent("price");
	}
	return $data;
}

/**
* Set price - Prix Public HT
* @param string $price
* @return \Pimcore\Model\Object\Product
*/
public function setPrice ($price) {
	$this->price = $price;
	return $this;
}

/**
* Get price_1 - Négoce (1)
* @return string
*/
public function getPrice_1 () {
	$preValue = $this->preGetValue("price_1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_1;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_1")->isEmpty($data)) {
		return $this->getValueFromParent("price_1");
	}
	return $data;
}

/**
* Set price_1 - Négoce (1)
* @param string $price_1
* @return \Pimcore\Model\Object\Product
*/
public function setPrice_1 ($price_1) {
	$this->price_1 = $price_1;
	return $this;
}

/**
* Get price_2 - Gros poseur (2)
* @return string
*/
public function getPrice_2 () {
	$preValue = $this->preGetValue("price_2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_2")->isEmpty($data)) {
		return $this->getValueFromParent("price_2");
	}
	return $data;
}

/**
* Set price_2 - Gros poseur (2)
* @param string $price_2
* @return \Pimcore\Model\Object\Product
*/
public function setPrice_2 ($price_2) {
	$this->price_2 = $price_2;
	return $this;
}

/**
* Get price_3 - Pro (3)
* @return string
*/
public function getPrice_3 () {
	$preValue = $this->preGetValue("price_3"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_3;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_3")->isEmpty($data)) {
		return $this->getValueFromParent("price_3");
	}
	return $data;
}

/**
* Set price_3 - Pro (3)
* @param string $price_3
* @return \Pimcore\Model\Object\Product
*/
public function setPrice_3 ($price_3) {
	$this->price_3 = $price_3;
	return $this;
}

/**
* Get price_4 - Public (4)
* @return string
*/
public function getPrice_4 () {
	$preValue = $this->preGetValue("price_4"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->price_4;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("price_4")->isEmpty($data)) {
		return $this->getValueFromParent("price_4");
	}
	return $data;
}

/**
* Set price_4 - Public (4)
* @param string $price_4
* @return \Pimcore\Model\Object\Product
*/
public function setPrice_4 ($price_4) {
	$this->price_4 = $price_4;
	return $this;
}

/**
* Get mage_visibility - mage_visibility
* @return string
*/
public function getMage_visibility () {
	$preValue = $this->preGetValue("mage_visibility"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_visibility;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_visibility")->isEmpty($data)) {
		return $this->getValueFromParent("mage_visibility");
	}
	return $data;
}

/**
* Set mage_visibility - mage_visibility
* @param string $mage_visibility
* @return \Pimcore\Model\Object\Product
*/
public function setMage_visibility ($mage_visibility) {
	$this->mage_visibility = $mage_visibility;
	return $this;
}

/**
* Get accessoirepopin - Checkout Products
* @return \Pimcore\Model\Object\product[] | \Pimcore\Model\Object\category[]
*/
public function getAccessoirepopin () {
	$preValue = $this->preGetValue("accessoirepopin"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->getClass()->getFieldDefinition("accessoirepopin")->preGetData($this);
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("accessoirepopin")->isEmpty($data)) {
		return $this->getValueFromParent("accessoirepopin");
	}
	return $data;
}

/**
* Set accessoirepopin - Checkout Products
* @param \Pimcore\Model\Object\product[] | \Pimcore\Model\Object\category[] $accessoirepopin
* @return \Pimcore\Model\Object\Product
*/
public function setAccessoirepopin ($accessoirepopin) {
	$this->accessoirepopin = $this->getClass()->getFieldDefinition("accessoirepopin")->preSetData($this, $accessoirepopin);
	return $this;
}

/**
* Get mage_accessoirepopin - Magento Product Checkout
* @return string
*/
public function getMage_accessoirepopin () {
	$preValue = $this->preGetValue("mage_accessoirepopin"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_accessoirepopin;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_accessoirepopin")->isEmpty($data)) {
		return $this->getValueFromParent("mage_accessoirepopin");
	}
	return $data;
}

/**
* Set mage_accessoirepopin - Magento Product Checkout
* @param string $mage_accessoirepopin
* @return \Pimcore\Model\Object\Product
*/
public function setMage_accessoirepopin ($mage_accessoirepopin) {
	$this->mage_accessoirepopin = $mage_accessoirepopin;
	return $this;
}

/**
* Get mage_name - Nom Magento
* @return string
*/
public function getMage_name () {
	$preValue = $this->preGetValue("mage_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_name")->isEmpty($data)) {
		return $this->getValueFromParent("mage_name");
	}
	return $data;
}

/**
* Set mage_name - Nom Magento
* @param string $mage_name
* @return \Pimcore\Model\Object\Product
*/
public function setMage_name ($mage_name) {
	$this->mage_name = $mage_name;
	return $this;
}

/**
* Get mage_short_name - Nom court Magento
* @return string
*/
public function getMage_short_name () {
	$preValue = $this->preGetValue("mage_short_name"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_short_name;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_short_name")->isEmpty($data)) {
		return $this->getValueFromParent("mage_short_name");
	}
	return $data;
}

/**
* Set mage_short_name - Nom court Magento
* @param string $mage_short_name
* @return \Pimcore\Model\Object\Product
*/
public function setMage_short_name ($mage_short_name) {
	$this->mage_short_name = $mage_short_name;
	return $this;
}

/**
* Get mage_meta_title - Mage Métas Title
* @return string
*/
public function getMage_meta_title () {
	$preValue = $this->preGetValue("mage_meta_title"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_meta_title;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_meta_title")->isEmpty($data)) {
		return $this->getValueFromParent("mage_meta_title");
	}
	return $data;
}

/**
* Set mage_meta_title - Mage Métas Title
* @param string $mage_meta_title
* @return \Pimcore\Model\Object\Product
*/
public function setMage_meta_title ($mage_meta_title) {
	$this->mage_meta_title = $mage_meta_title;
	return $this;
}

/**
* Get mage_teinte - Mage Teinte
* @return string
*/
public function getMage_teinte () {
	$preValue = $this->preGetValue("mage_teinte"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_teinte;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_teinte")->isEmpty($data)) {
		return $this->getValueFromParent("mage_teinte");
	}
	return $data;
}

/**
* Set mage_teinte - Mage Teinte
* @param string $mage_teinte
* @return \Pimcore\Model\Object\Product
*/
public function setMage_teinte ($mage_teinte) {
	$this->mage_teinte = $mage_teinte;
	return $this;
}

/**
* Get mage_teinte_level0 - Mage Teinte Level0
* @return string
*/
public function getMage_teinte_level0 () {
	$preValue = $this->preGetValue("mage_teinte_level0"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_teinte_level0;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_teinte_level0")->isEmpty($data)) {
		return $this->getValueFromParent("mage_teinte_level0");
	}
	return $data;
}

/**
* Set mage_teinte_level0 - Mage Teinte Level0
* @param string $mage_teinte_level0
* @return \Pimcore\Model\Object\Product
*/
public function setMage_teinte_level0 ($mage_teinte_level0) {
	$this->mage_teinte_level0 = $mage_teinte_level0;
	return $this;
}

/**
* Get mage_teinte_level1 - Mage Teinte Level1
* @return string
*/
public function getMage_teinte_level1 () {
	$preValue = $this->preGetValue("mage_teinte_level1"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_teinte_level1;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_teinte_level1")->isEmpty($data)) {
		return $this->getValueFromParent("mage_teinte_level1");
	}
	return $data;
}

/**
* Set mage_teinte_level1 - Mage Teinte Level1
* @param string $mage_teinte_level1
* @return \Pimcore\Model\Object\Product
*/
public function setMage_teinte_level1 ($mage_teinte_level1) {
	$this->mage_teinte_level1 = $mage_teinte_level1;
	return $this;
}

/**
* Get mage_teinte_level2 - Mage Teinte Level2
* @return string
*/
public function getMage_teinte_level2 () {
	$preValue = $this->preGetValue("mage_teinte_level2"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_teinte_level2;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_teinte_level2")->isEmpty($data)) {
		return $this->getValueFromParent("mage_teinte_level2");
	}
	return $data;
}

/**
* Set mage_teinte_level2 - Mage Teinte Level2
* @param string $mage_teinte_level2
* @return \Pimcore\Model\Object\Product
*/
public function setMage_teinte_level2 ($mage_teinte_level2) {
	$this->mage_teinte_level2 = $mage_teinte_level2;
	return $this;
}

/**
* Get mage_meta_description - Mage Métas Description
* @return string
*/
public function getMage_meta_description () {
	$preValue = $this->preGetValue("mage_meta_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_meta_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_meta_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_meta_description");
	}
	return $data;
}

/**
* Set mage_meta_description - Mage Métas Description
* @param string $mage_meta_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_meta_description ($mage_meta_description) {
	$this->mage_meta_description = $mage_meta_description;
	return $this;
}

/**
* Get mage_lesplus - Les Plus 
* @return string
*/
public function getMage_lesplus () {
	$preValue = $this->preGetValue("mage_lesplus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_lesplus;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_lesplus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_lesplus");
	}
	return $data;
}

/**
* Set mage_lesplus - Les Plus 
* @param string $mage_lesplus
* @return \Pimcore\Model\Object\Product
*/
public function setMage_lesplus ($mage_lesplus) {
	$this->mage_lesplus = $mage_lesplus;
	return $this;
}

/**
* Get mage_description - Description Magento
* @return string
*/
public function getMage_description () {
	$preValue = $this->preGetValue("mage_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_description");
	}
	return $data;
}

/**
* Set mage_description - Description Magento
* @param string $mage_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_description ($mage_description) {
	$this->mage_description = $mage_description;
	return $this;
}

/**
* Get mage_sub_description - Sous description / Liste de caract.
* @return string
*/
public function getMage_sub_description () {
	$preValue = $this->preGetValue("mage_sub_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_sub_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_sub_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_sub_description");
	}
	return $data;
}

/**
* Set mage_sub_description - Sous description / Liste de caract.
* @param string $mage_sub_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_sub_description ($mage_sub_description) {
	$this->mage_sub_description = $mage_sub_description;
	return $this;
}

/**
* Get characteristics - Characteristics
* @return string
*/
public function getCharacteristics () {
	$preValue = $this->preGetValue("characteristics"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->characteristics;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("characteristics")->isEmpty($data)) {
		return $this->getValueFromParent("characteristics");
	}
	return $data;
}

/**
* Set characteristics - Characteristics
* @param string $characteristics
* @return \Pimcore\Model\Object\Product
*/
public function setCharacteristics ($characteristics) {
	$this->characteristics = $characteristics;
	return $this;
}

/**
* Get mage_guideline - Guidelines
* @return string
*/
public function getMage_guideline () {
	$preValue = $this->preGetValue("mage_guideline"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_guideline;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_guideline")->isEmpty($data)) {
		return $this->getValueFromParent("mage_guideline");
	}
	return $data;
}

/**
* Set mage_guideline - Guidelines
* @param string $mage_guideline
* @return \Pimcore\Model\Object\Product
*/
public function setMage_guideline ($mage_guideline) {
	$this->mage_guideline = $mage_guideline;
	return $this;
}

/**
* Get mage_associated_articles - Associated Articles Path
* @return string
*/
public function getMage_associated_articles () {
	$preValue = $this->preGetValue("mage_associated_articles"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_associated_articles;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_associated_articles")->isEmpty($data)) {
		return $this->getValueFromParent("mage_associated_articles");
	}
	return $data;
}

/**
* Set mage_associated_articles - Associated Articles Path
* @param string $mage_associated_articles
* @return \Pimcore\Model\Object\Product
*/
public function setMage_associated_articles ($mage_associated_articles) {
	$this->mage_associated_articles = $mage_associated_articles;
	return $this;
}

/**
* Get image_1_src - Image 1 SRC
* @return string
*/
public function getImage_1_src () {
	$preValue = $this->preGetValue("image_1_src"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_1_src;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_1_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_1_src");
	}
	return $data;
}

/**
* Set image_1_src - Image 1 SRC
* @param string $image_1_src
* @return \Pimcore\Model\Object\Product
*/
public function setImage_1_src ($image_1_src) {
	$this->image_1_src = $image_1_src;
	return $this;
}

/**
* Get image_2_src - Image 2 src
* @return string
*/
public function getImage_2_src () {
	$preValue = $this->preGetValue("image_2_src"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_2_src;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_2_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_2_src");
	}
	return $data;
}

/**
* Set image_2_src - Image 2 src
* @param string $image_2_src
* @return \Pimcore\Model\Object\Product
*/
public function setImage_2_src ($image_2_src) {
	$this->image_2_src = $image_2_src;
	return $this;
}

/**
* Get image_3_src - Image 3 src
* @return string
*/
public function getImage_3_src () {
	$preValue = $this->preGetValue("image_3_src"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->image_3_src;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("image_3_src")->isEmpty($data)) {
		return $this->getValueFromParent("image_3_src");
	}
	return $data;
}

/**
* Set image_3_src - Image 3 src
* @param string $image_3_src
* @return \Pimcore\Model\Object\Product
*/
public function setImage_3_src ($image_3_src) {
	$this->image_3_src = $image_3_src;
	return $this;
}

/**
* Get mage_mediagallery - Mage Gallery
* @return string
*/
public function getMage_mediagallery () {
	$preValue = $this->preGetValue("mage_mediagallery"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_mediagallery;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_mediagallery")->isEmpty($data)) {
		return $this->getValueFromParent("mage_mediagallery");
	}
	return $data;
}

/**
* Set mage_mediagallery - Mage Gallery
* @param string $mage_mediagallery
* @return \Pimcore\Model\Object\Product
*/
public function setMage_mediagallery ($mage_mediagallery) {
	$this->mage_mediagallery = $mage_mediagallery;
	return $this;
}

/**
* Get mage_fichepdf - Fiche PDF
* @return string
*/
public function getMage_fichepdf () {
	$preValue = $this->preGetValue("mage_fichepdf"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_fichepdf;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_fichepdf")->isEmpty($data)) {
		return $this->getValueFromParent("mage_fichepdf");
	}
	return $data;
}

/**
* Set mage_fichepdf - Fiche PDF
* @param string $mage_fichepdf
* @return \Pimcore\Model\Object\Product
*/
public function setMage_fichepdf ($mage_fichepdf) {
	$this->mage_fichepdf = $mage_fichepdf;
	return $this;
}

/**
* Get mage_notice_pose_lpn - Notice de pose
* @return string
*/
public function getMage_notice_pose_lpn () {
	$preValue = $this->preGetValue("mage_notice_pose_lpn"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_notice_pose_lpn;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_notice_pose_lpn")->isEmpty($data)) {
		return $this->getValueFromParent("mage_notice_pose_lpn");
	}
	return $data;
}

/**
* Set mage_notice_pose_lpn - Notice de pose
* @param string $mage_notice_pose_lpn
* @return \Pimcore\Model\Object\Product
*/
public function setMage_notice_pose_lpn ($mage_notice_pose_lpn) {
	$this->mage_notice_pose_lpn = $mage_notice_pose_lpn;
	return $this;
}

/**
* Get mage_invoice_description - Description pour facture
* @return string
*/
public function getMage_invoice_description () {
	$preValue = $this->preGetValue("mage_invoice_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_invoice_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_invoice_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_invoice_description");
	}
	return $data;
}

/**
* Set mage_invoice_description - Description pour facture
* @param string $mage_invoice_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_invoice_description ($mage_invoice_description) {
	$this->mage_invoice_description = $mage_invoice_description;
	return $this;
}

/**
* Get mage_realisations - Réalisations
* @return string
*/
public function getMage_realisations () {
	$preValue = $this->preGetValue("mage_realisations"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_realisations;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_realisations")->isEmpty($data)) {
		return $this->getValueFromParent("mage_realisations");
	}
	return $data;
}

/**
* Set mage_realisations - Réalisations
* @param string $mage_realisations
* @return \Pimcore\Model\Object\Product
*/
public function setMage_realisations ($mage_realisations) {
	$this->mage_realisations = $mage_realisations;
	return $this;
}

/**
* Get mage_realisationsJson - Réalisations (JSON)
* @return string
*/
public function getMage_realisationsJson () {
	$preValue = $this->preGetValue("mage_realisationsJson"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_realisationsJson;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_realisationsJson")->isEmpty($data)) {
		return $this->getValueFromParent("mage_realisationsJson");
	}
	return $data;
}

/**
* Set mage_realisationsJson - Réalisations (JSON)
* @param string $mage_realisationsJson
* @return \Pimcore\Model\Object\Product
*/
public function setMage_realisationsJson ($mage_realisationsJson) {
	$this->mage_realisationsJson = $mage_realisationsJson;
	return $this;
}

/**
* Get mage_config_description - Description Pour configurateur
* @return string
*/
public function getMage_config_description () {
	$preValue = $this->preGetValue("mage_config_description"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_config_description;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_config_description")->isEmpty($data)) {
		return $this->getValueFromParent("mage_config_description");
	}
	return $data;
}

/**
* Set mage_config_description - Description Pour configurateur
* @param string $mage_config_description
* @return \Pimcore\Model\Object\Product
*/
public function setMage_config_description ($mage_config_description) {
	$this->mage_config_description = $mage_config_description;
	return $this;
}

/**
* Get mage_re_skus - Related SKUS
* @return string
*/
public function getMage_re_skus () {
	$preValue = $this->preGetValue("mage_re_skus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_re_skus;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_re_skus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_re_skus");
	}
	return $data;
}

/**
* Set mage_re_skus - Related SKUS
* @param string $mage_re_skus
* @return \Pimcore\Model\Object\Product
*/
public function setMage_re_skus ($mage_re_skus) {
	$this->mage_re_skus = $mage_re_skus;
	return $this;
}

/**
* Get mage_produitspose - Category Magentà Pose
* @return string
*/
public function getMage_produitspose () {
	$preValue = $this->preGetValue("mage_produitspose"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_produitspose;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_produitspose")->isEmpty($data)) {
		return $this->getValueFromParent("mage_produitspose");
	}
	return $data;
}

/**
* Set mage_produitspose - Category Magentà Pose
* @param string $mage_produitspose
* @return \Pimcore\Model\Object\Product
*/
public function setMage_produitspose ($mage_produitspose) {
	$this->mage_produitspose = $mage_produitspose;
	return $this;
}

/**
* Get mage_produitsfinition - Category Magento Finition
* @return string
*/
public function getMage_produitsfinition () {
	$preValue = $this->preGetValue("mage_produitsfinition"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_produitsfinition;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_produitsfinition")->isEmpty($data)) {
		return $this->getValueFromParent("mage_produitsfinition");
	}
	return $data;
}

/**
* Set mage_produitsfinition - Category Magento Finition
* @param string $mage_produitsfinition
* @return \Pimcore\Model\Object\Product
*/
public function setMage_produitsfinition ($mage_produitsfinition) {
	$this->mage_produitsfinition = $mage_produitsfinition;
	return $this;
}

/**
* Get mage_produitsentretien - Category Magento Entretien
* @return string
*/
public function getMage_produitsentretien () {
	$preValue = $this->preGetValue("mage_produitsentretien"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_produitsentretien;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_produitsentretien")->isEmpty($data)) {
		return $this->getValueFromParent("mage_produitsentretien");
	}
	return $data;
}

/**
* Set mage_produitsentretien - Category Magento Entretien
* @param string $mage_produitsentretien
* @return \Pimcore\Model\Object\Product
*/
public function setMage_produitsentretien ($mage_produitsentretien) {
	$this->mage_produitsentretien = $mage_produitsentretien;
	return $this;
}

/**
* Get mage_cs_skus - Crossels SKUS
* @return string
*/
public function getMage_cs_skus () {
	$preValue = $this->preGetValue("mage_cs_skus"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_cs_skus;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_cs_skus")->isEmpty($data)) {
		return $this->getValueFromParent("mage_cs_skus");
	}
	return $data;
}

/**
* Set mage_cs_skus - Crossels SKUS
* @param string $mage_cs_skus
* @return \Pimcore\Model\Object\Product
*/
public function setMage_cs_skus ($mage_cs_skus) {
	$this->mage_cs_skus = $mage_cs_skus;
	return $this;
}

/**
* Get mage_origine_arbre - Origine Arbre
* @return string
*/
public function getMage_origine_arbre () {
	$preValue = $this->preGetValue("mage_origine_arbre"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_origine_arbre;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_origine_arbre")->isEmpty($data)) {
		return $this->getValueFromParent("mage_origine_arbre");
	}
	return $data;
}

/**
* Set mage_origine_arbre - Origine Arbre
* @param string $mage_origine_arbre
* @return \Pimcore\Model\Object\Product
*/
public function setMage_origine_arbre ($mage_origine_arbre) {
	$this->mage_origine_arbre = $mage_origine_arbre;
	return $this;
}

/**
* Get configurableFields - Champs configurables
* @return string
*/
public function getConfigurableFields () {
	$preValue = $this->preGetValue("configurableFields"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->configurableFields;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("configurableFields")->isEmpty($data)) {
		return $this->getValueFromParent("configurableFields");
	}
	return $data;
}

/**
* Set configurableFields - Champs configurables
* @param string $configurableFields
* @return \Pimcore\Model\Object\Product
*/
public function setConfigurableFields ($configurableFields) {
	$this->configurableFields = $configurableFields;
	return $this;
}

/**
* Get childrenSimpleProductIds_flat - Sous produits
* @return string
*/
public function getChildrenSimpleProductIds_flat () {
	$preValue = $this->preGetValue("childrenSimpleProductIds_flat"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->childrenSimpleProductIds_flat;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("childrenSimpleProductIds_flat")->isEmpty($data)) {
		return $this->getValueFromParent("childrenSimpleProductIds_flat");
	}
	return $data;
}

/**
* Set childrenSimpleProductIds_flat - Sous produits
* @param string $childrenSimpleProductIds_flat
* @return \Pimcore\Model\Object\Product
*/
public function setChildrenSimpleProductIds_flat ($childrenSimpleProductIds_flat) {
	$this->childrenSimpleProductIds_flat = $childrenSimpleProductIds_flat;
	return $this;
}

/**
* Get teinte_lpn - Teinte
* @return string
*/
public function getTeinte_lpn () {
	$preValue = $this->preGetValue("teinte_lpn"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->teinte_lpn;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("teinte_lpn")->isEmpty($data)) {
		return $this->getValueFromParent("teinte_lpn");
	}
	return $data;
}

/**
* Set teinte_lpn - Teinte
* @param string $teinte_lpn
* @return \Pimcore\Model\Object\Product
*/
public function setTeinte_lpn ($teinte_lpn) {
	$this->teinte_lpn = $teinte_lpn;
	return $this;
}

/**
* Get mage_tags - Tags
* @return string
*/
public function getMage_tags () {
	$preValue = $this->preGetValue("mage_tags"); 
	if($preValue !== null && !\Pimcore::inAdmin()) { 
		return $preValue;
	}
	$data = $this->mage_tags;
	if(\Pimcore\Model\Object::doGetInheritedValues() && $this->getClass()->getFieldDefinition("mage_tags")->isEmpty($data)) {
		return $this->getValueFromParent("mage_tags");
	}
	return $data;
}

/**
* Set mage_tags - Tags
* @param string $mage_tags
* @return \Pimcore\Model\Object\Product
*/
public function setMage_tags ($mage_tags) {
	$this->mage_tags = $mage_tags;
	return $this;
}

protected static $_relationFields = array (
  'plusValue' => 
  array (
    'type' => 'href',
  ),
  'pimonly_teinte_rel' => 
  array (
    'type' => 'objects',
  ),
  'gallery' => 
  array (
    'type' => 'multihref',
  ),
  'extras' => 
  array (
    'type' => 'objects',
  ),
  'realisations' => 
  array (
    'type' => 'multihref',
  ),
  'fiche_technique_lpn' => 
  array (
    'type' => 'href',
  ),
  'fiche_technique_orginale' => 
  array (
    'type' => 'href',
  ),
  'notice_pose_lpn' => 
  array (
    'type' => 'href',
  ),
  'fiche_securite' => 
  array (
    'type' => 'href',
  ),
  'fiche_entretien' => 
  array (
    'type' => 'href',
  ),
  'fiche_pose' => 
  array (
    'type' => 'href',
  ),
  're_skus' => 
  array (
    'type' => 'objects',
  ),
  'cs_skus' => 
  array (
    'type' => 'objects',
  ),
  'pimonly_category_pose' => 
  array (
    'type' => 'href',
  ),
  'pimonly_category_finition' => 
  array (
    'type' => 'href',
  ),
  'pimonly_category_entretien' => 
  array (
    'type' => 'href',
  ),
  'associatedArticles' => 
  array (
    'type' => 'objects',
  ),
  'origineArticles' => 
  array (
    'type' => 'objects',
  ),
  'accessoirepopin' => 
  array (
    'type' => 'objects',
  ),
);

public $lazyLoadedFields = array (
  0 => 'plusValue',
  1 => 'fiche_entretien',
  2 => 'fiche_pose',
);

}

