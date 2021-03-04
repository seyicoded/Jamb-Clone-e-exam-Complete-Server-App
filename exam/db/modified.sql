--run this on mysql command line or anyhow you know how to -----connect to jude db first

DELETE FROM `subjects`;
INSERT INTO `subjects` (`sub_id`, `sub_name`) VALUES
(1, 'English Language'),
(2, 'Mathematics'),
(3, 'Physics'),
(4, 'Chemistry'),
(5, 'Agric'),
(6, 'Biology'),
(7, 'Government'),
(8, 'Commerce'),
(9, 'Econommic');

--clean users
DELETE FROM `registration`;

-- CREATE TABLE score(score_id,reg_numb,score1,score2,score3,score4,n1,n2,n3,n4,time);
--at the end of the exam you will insert into score the data needed

--create table question_list(question_id,subject_id,Question)
--create table option_list(option_id,question_id,qo_1,qo_2,qo_3,qo_4)
--create table answer_list(answer_id,question_id,answer)

--for understanding: each question will have a unique id called (question_id) in-which all option will depend on that question_id and answer will depend on it too
--each question will be linked to subject_id inwhich the present subject the user click will be stored in a session

--CREATE TABLE temp_sess(temp_id,sub_id,question_id,answer,reg_num); so that it can keep track of the question answer by users


--use ajax to tranmsit info. 

CREATE TABLE question_list(question_id INTEGER PRIMARY KEY AUTO_INCREMENT,subject_id INTEGER NOT NULL,Question BLOB NOT NULL);

CREATE TABLE option_list(option_id INTEGER PRIMARY KEY AUTO_INCREMENT,question_id INTEGER NOT NULL,qo_1 BLOB NOT NULL,qo_2 BLOB NOT NULL,qo_3 BLOB NOT NULL,qo_4 BLOB NOT NULL);

CREATE TABLE answer_list(answer_id INTEGER PRIMARY KEY AUTO_INCREMENT,question_id INTEGER NOT NULL,answer BLOB NOT NULL);

CREATE TABLE score(score_id INTEGER PRIMARY KEY AUTO_INCREMENT,reg_numb BLOB NOT NULL,score1 INTEGER,score2 INTEGER,score3 INTEGER,score4 INTEGER,n1 INTEGER,n2 INTEGER,n3 INTEGER,n4 INTEGER,time TIMESTAMP);

CREATE TABLE temp_sess(temp_id INTEGER PRIMARY KEY AUTO_INCREMENT,sub_id INTEGER NOT NULL,question_id INTEGER NOT NULL,answer BLOB NOT NULL,reg_num BLOB NOT NULL);

INSERT INTO question_list(subject_id,Question) VALUES(1,'WHAT IS A NOUN'),(2,'Find the derivative of 2X^2 using first principle');
INSERT INTO option_list(question_id,qo_1,qo_2,qo_3,qo_4) VALUES(1,'The abbreviation of my university','Thesame name with my dog ','A name of anything','my p.man name'),(2,'4X','1X^2','5x^7','4');
INSERT INTO answer_list(question_id,answer) VALUES(1,'A name of anything'),(2,'4X');
