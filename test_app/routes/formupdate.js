const express = require('express');
var router = express.Router();
var db = require('../database');

/* Moddifier un utlisateur */

/*Ouvrir la vue pour modifier l'utilisateur*/
router.get('/:id', function (req, res, next) {
    var id = req.params.id;
    db.query(`SELECT * FROM contacts WHERE id = "${id}"`, (err, rows) => {
        if (err) throw err;
        res.render('formupdate', { formupdate: rows[0] });

    });
});

/* Récupérer les valeurs en post */

router.post('/:id', function (req, res, next) {
    /* Récupérer chaque valeur des inputs */
    var id = req.params.id;
    var fName = req.body.f_name;
    var lName = req.body.l_name;
    var Email = req.body.email;
    var Message = req.body.message;
    /* Envoyer les valeurs dans la base de données */
    db.query(`UPDATE contacts SET f_name = "${fName}", l_name = "${lName}", email = "${Email}", message = "${Message}" WHERE id = "${id}"`, function (err, data) {
        if (err) throw err;
        res.redirect("/users")
    });
});

module.exports = router;