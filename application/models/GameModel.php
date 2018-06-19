<?php

class GameModel extends Model{
	
	public function getCategories(){
		$q = $this->db->select('categories');

		return $q->results();
	}

	public function getLetters(){
		return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 
				'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
	}

	// Get ranodm word from coresponding category
	public function getRandomFromCategory($catId){
		$q = $this->db->select('words', '*', ['cat_id' => $catId]);

		// Get random index
		$i = mt_rand(0, $q->rows() - 1);

		return $q->results()[$i];
	}

	// Get user stats
	public function getStatistics($playerId){
		$q = $this->db->select('users', 
				['games_played', 'games_won', 'games_lost', 'letter_guesses', 'full_words_guessed'], 
				['id' => $playerId]
		);

		return $q->first();
	}

	public function updateUserStats($playerId, $field){
		$sql = "UPDATE users SET $field = $field + 1"; // Increment chosen field by 1

		// If 'won' or 'lost', increment 'played' too
		if($field === 'games_won' || $field === 'games_lost') $sql .= ", games_played = games_played + 1";

		$sql .= " WHERE id = :id";

		$stmt = $this->db->prepare($sql);
		$stmt->execute(['id' => $playerId]);
		
		return $stmt->rowCount() > 0;
	}
}