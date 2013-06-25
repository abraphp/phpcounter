
CREATE TABLE user_resources (
                urid TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(31) NOT NULL,
                icon VARCHAR(127) NOT NULL,
                base_url VARCHAR(255) NOT NULL,
                PRIMARY KEY (urid)
) ENGINE=InnoDB;


CREATE TABLE psrs (
                id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
                identifier VARCHAR(7) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_psrs_identifier
 ON psrs
 ( identifier );

CREATE TABLE certifications (
                id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(23) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_certifications_name
 ON certifications
 ( name );

CREATE TABLE application_environments (
                id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(123) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_application_types_name
 ON application_environments
 ( name );

CREATE TABLE census (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                year SMALLINT NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_census_year
 ON census
 ( year );

CREATE TABLE versioning_systems (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(63) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_versioning_systems_name
 ON versioning_systems
 ( name );

CREATE TABLE webservers (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(63) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_webservers_name
 ON webservers
 ( name );

CREATE TABLE working_regimes (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(127) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_working_regimes_name
 ON working_regimes
 ( name );

CREATE TABLE `databases` (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(63) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_databases_name
 ON `databases`
 ( name );

CREATE TABLE editors (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(127) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE payment_ranges (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                minimum NUMERIC(11,2) NOT NULL,
                maximum NUMERIC(11,2) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_payment_ranges_range
 ON payment_ranges
 ( minimum, maximum );

CREATE TABLE sensitive_answers (
                id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
                census_id INT UNSIGNED NOT NULL,
                payment_range_id SMALLINT UNSIGNED NOT NULL,
                working_regime_id SMALLINT UNSIGNED NOT NULL,
                PRIMARY KEY (id, census_id)
) ENGINE=InnoDB;


CREATE TABLE operating_systems (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_operating_systems_name
 ON operating_systems
 ( name );

CREATE TABLE frameworks (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_frameworks_name
 ON frameworks
 ( name );

CREATE TABLE language_versions (
                id SMALLINT UNSIGNED AUTO_INCREMENT NOT NULL,
                version VARCHAR(8) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_language_versions_version
 ON language_versions
 ( version );

CREATE TABLE countries (
                country_id TINYINT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(127) NOT NULL,
                iso3166 CHAR(3) NOT NULL,
                PRIMARY KEY (country_id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX uq_country_name
 ON countries
 ( name );

CREATE UNIQUE INDEX uq_countries_iso3166
 ON countries
 ( iso3166 );

CREATE TABLE states (
                state_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                country_id TINYINT UNSIGNED NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (state_id)
) ENGINE=InnoDB;


CREATE TABLE cities (
                city_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                state_id INT UNSIGNED NOT NULL,
                name VARCHAR(255) NOT NULL,
                PRIMARY KEY (city_id)
) ENGINE=InnoDB;


CREATE TABLE communities (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                country_id TINYINT UNSIGNED,
                state_id INT UNSIGNED,
                city_id INT UNSIGNED,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE TABLE users (
                id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
                city_id INT UNSIGNED NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                PRIMARY KEY (id)
) ENGINE=InnoDB;


CREATE UNIQUE INDEX un_users_email
 ON users
 ( email );

CREATE TABLE answers (
                user_id BIGINT UNSIGNED NOT NULL,
                census_id INT UNSIGNED NOT NULL,
                operating_system_id SMALLINT UNSIGNED NOT NULL,
                framework_id SMALLINT UNSIGNED,
                language_version_id SMALLINT UNSIGNED NOT NULL,
                editor_id SMALLINT UNSIGNED NOT NULL,
                database_id SMALLINT UNSIGNED,
                community_id INT UNSIGNED NOT NULL,
                webserver_id SMALLINT UNSIGNED NOT NULL,
                versioning_system_id SMALLINT UNSIGNED NOT NULL,
                application_environment_id TINYINT UNSIGNED NOT NULL,
                psr_id TINYINT UNSIGNED NOT NULL,
                PRIMARY KEY (user_id, census_id)
) ENGINE=InnoDB;


CREATE TABLE answers_certifications (
                user_id BIGINT UNSIGNED NOT NULL,
                census_id INT UNSIGNED NOT NULL,
                certification_id TINYINT UNSIGNED NOT NULL,
                PRIMARY KEY (user_id, census_id, certification_id)
) ENGINE=InnoDB;


CREATE TABLE profiles (
                user_id BIGINT UNSIGNED NOT NULL,
                urid TINYINT UNSIGNED NOT NULL,
                identifier VARCHAR(127) NOT NULL,
                PRIMARY KEY (user_id, urid)
) ENGINE=InnoDB;


ALTER TABLE profiles ADD CONSTRAINT user_resources_profiles_fk
FOREIGN KEY (urid)
REFERENCES user_resources (urid)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT psrs_answers_fk
FOREIGN KEY (psr_id)
REFERENCES psrs (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers_certifications ADD CONSTRAINT certifications_answers_certifications_fk
FOREIGN KEY (certification_id)
REFERENCES certifications (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT application_types_answers_fk
FOREIGN KEY (application_environment_id)
REFERENCES application_environments (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT census_answers_fk
FOREIGN KEY (census_id)
REFERENCES census (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sensitive_answers ADD CONSTRAINT census_sensitive_answers_fk
FOREIGN KEY (census_id)
REFERENCES census (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT versioning_systems_answers_fk
FOREIGN KEY (versioning_system_id)
REFERENCES versioning_systems (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT webservers_answers_fk
FOREIGN KEY (webserver_id)
REFERENCES webservers (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sensitive_answers ADD CONSTRAINT working_regimes_sensitive_answers_fk
FOREIGN KEY (working_regime_id)
REFERENCES working_regimes (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT databases_answers_fk
FOREIGN KEY (database_id)
REFERENCES `databases` (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT ides_answers_fk
FOREIGN KEY (editor_id)
REFERENCES editors (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE sensitive_answers ADD CONSTRAINT payment_ranges_payment_ranges_answers_fk
FOREIGN KEY (payment_range_id)
REFERENCES payment_ranges (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT operating_systems_answers_fk
FOREIGN KEY (operating_system_id)
REFERENCES operating_systems (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT frameworks_answers_fk
FOREIGN KEY (framework_id)
REFERENCES frameworks (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT language_versions_answers_fk
FOREIGN KEY (language_version_id)
REFERENCES language_versions (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE states ADD CONSTRAINT countries_states_fk
FOREIGN KEY (country_id)
REFERENCES countries (country_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE communities ADD CONSTRAINT countries_communities_fk
FOREIGN KEY (country_id)
REFERENCES countries (country_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE cities ADD CONSTRAINT states_cities_fk
FOREIGN KEY (state_id)
REFERENCES states (state_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE communities ADD CONSTRAINT states_communities_fk
FOREIGN KEY (state_id)
REFERENCES states (state_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE users ADD CONSTRAINT cities_users_fk
FOREIGN KEY (city_id)
REFERENCES cities (city_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE communities ADD CONSTRAINT cities_communities_fk
FOREIGN KEY (city_id)
REFERENCES cities (city_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT communities_answers_fk
FOREIGN KEY (community_id)
REFERENCES communities (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE profiles ADD CONSTRAINT users_profiles_fk
FOREIGN KEY (user_id)
REFERENCES users (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers ADD CONSTRAINT users_answers_fk
FOREIGN KEY (user_id)
REFERENCES users (id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE answers_certifications ADD CONSTRAINT answers_answers_certifications_fk
FOREIGN KEY (census_id, user_id)
REFERENCES answers (census_id, user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
