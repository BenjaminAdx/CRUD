const express = require('express');
var router = express.Router();
var db = require('../database');

/* Afficher le formulaire à l'utilisateur */
router.get('/', function (req, res, next) {
    res.render('form');
});

/* Récupérer les valeurs en post */

router.post('/', function (req, res, next) {
    /* Récupérer chaque valeur des inputs */
    var fName = req.body.f_name;
    var lName = req.body.l_name;
    var Email = req.body.email;
    var Message = req.body.message;
    /* Envoyer les valeurs dans la base de données */
    db.query(`INSERT INTO contacts (f_name, l_name, email, message) VALUES ("${fName}", "${lName}", "${Email}", "${Message}")`, function (err, data) {
        if (err) throw err;
        res.redirect("/users")
    });
});


module.exports = router;