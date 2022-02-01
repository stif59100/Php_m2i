## Nouvelle inscription

START TRANSACTION;

INSERT INTO user(name_user, firstname_user, pseudo_user, email_user, password_user) VALUES ('Mulder','fox','Le Martien', 'fox.mulder@fbi.com', 'test');
SELECT LAST_INSERT_ID();
SELECT id_round FROM round WHERE name_round = 'test';
INSERT INTO round_player(id_user, id_round) SELECT LAST_INSERT_ID(), id_round FROM round WHERE name_round = 'première';

## SELECT * FROM user u NATURAL JOIN round_player NATURAL JOIN round WHERE u.id_user = LAST_INSERT_ID();
COMMIT;
## ROLLBACK;

## désincription
START TRANSACTION;

DELETE FROM round_player WHERE id_user=(SELECT Max(id_user) from user);
DELETE FROM user WHERE id_user=(SELECT Max(id_user) from user);
COMMIT;
## ROLLBACK;


