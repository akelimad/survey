create table surveys(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  name varchar(100) ,
  description varchar(255) ,
  created_by INT UNSIGNED ,
  created_at datetime ,
  updated_at datetime 
);

create table survey_groups(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  name varchar(255) ,
  description varchar(255)
);

create table survey_questions(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  name varchar(255) ,
  type varchar(255)
  survey_id INT UNSIGNED
  group_id INT DEFAULT (0)
);

create table survey_question_answers(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,
  survey_question_id INT UNSIGNED ,
  name varchar(100) ,
  is_correct tinyInt
);

create table survey_attachements(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  object_id INT UNSIGNED ,
  object_name varchar(100) ,
  file_name varchar(100) ,
  title varchar(100)
);

create table survey_responses(
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  survey_question_id INT UNSIGNED ,
  survey_question_answer_id INT UNSIGNED
);