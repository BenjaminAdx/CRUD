var express = require('express');
var router = express.Router();
var db = require('../database');

/* GET users page. */
router.get('/', function (req, res, next) {
  db.query('SELECT * FROM contacts', (err, rows) => {
    if (err) throw err;
    res.render('users', { users: rows });
  });
});

/* Supprimer un utilisateur */

router.get('/:id', function (req, res, next) {
  var id = req.params.id;
  db.query(`DELETE FROM contacts WHERE id = "${id}"`, (err, rows) => {
    if (err) throw err;
    res.redirect("../users");
  });
});


module.exports = router;
