 <div id="options" class="blocFormulaire options">

     <h2>Options</h2>
     <h3>Réserver un emplacement de tente : </h3>
     <div class="choixnuit">
         <input type="checkbox" id="tenteNuit1" name="tenteNuit1">
         <label for="tenteNuit1">Pour la nuit du 01/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="tenteNuit2" name="tenteNuit2">
         <label for="tenteNuit2">Pour la nuit du 02/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="tenteNuit3" name="tenteNuit3">
         <label for="tenteNuit3">Pour la nuit du 03/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="tente3Nuits" name="tente3Nuits">
         <label for="tente3Nuits">Pour les 3 nuits (12€)</label>
     </div>

     <h3>Réserver un emplacement de camion aménagé : </h3>
     <div class="choixnuit">
         <input type="checkbox" id="vanNuit1" name="vanNuit1">
         <label for="vanNuit1">Pour la nuit du 01/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="vanNuit2" name="vanNuit2">
         <label for="vanNuit2">Pour la nuit du 02/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="vanNuit3" name="vanNuit3">
         <label for="vanNuit3">Pour la nuit du 03/07 (5€)</label>
     </div>
     <div class="choixnuit">
         <input type="checkbox" id="van3Nuits" name="van3Nuits">
         <label for="van3Nuits">Pour les 3 nuits (12€)</label>
     </div>

     <h3>Venez-vous avec des enfants ?</h3>
     <div class="divenfants">
         <input type="checkbox" name="enfantsOui"><label for="enfantsOui">Oui</label>
     </div>
     <div class="divenfants">
         <input type="checkbox" name="enfantsNon"><label for="enfantsNon">Non</label>
     </div>


     <!-- Si oui, afficher : -->
     <section class="casqueEnfant tarifHidden">
         <h4>Voulez-vous louer un casque antibruit pour enfants* (2€ / casque) ?</h4>
         <label for="nombreCasquesEnfants">Nombre de casques souhaités :</label>
         <input type="number" name="nombreCasquesEnfants" id="nombreCasquesEnfants" min="0">
         <p>*Dans la limite des stocks disponibles.</p>
         <div class="messageErreurCasques"></div>
     </section>

     <h3>Profitez de descentes en luge d'été à tarifs avantageux !</h3>

     <div class="divluge">
         <label for="NombreLugesEte">Nombre de descentes en luge d'été (5€/descentes) :</label>
         <input type="number" name="NombreLugesEte" id="NombreLugesEte" min="0">
         <div class="messageErreurLuge"></div>
     </div>

     <p class="bouton boutonOptions" onclick="suivant2(blocOptions, blocCoordonnees)">Suivant</p>
     <p class="bouton" onclick="precedent(blocOptions, blocReservation)">Précédent</p>

 </div>