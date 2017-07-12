(function () {
    const div = document.getElementById('tabuleiro');
    const height = 20;
    const width = 12;
    const arena = createMatrix(width,height);
    let table = createTable(width,height);
    var gamePaused = false;
    const player = {
        pos: {x: 0, y: 0},
        matrix: null,
        score: 0,
    } 

    const colors = [
        null,
        'blue',
        'red',
        'orange',
        'green',
        'yellow',
        'pink',
        'brown',
        'black',
        'violet',
    ];

function initiateGame (){
    div.appendChild(table);
    playerReset();
    draw();
    loop();

}

function loop () {
    if(!gamePaused) {
    	setTimeout(function (){
    	    playerDrop();
            draw();
            requestAnimationFrame(function() {
           	 loop();
            });
    	},1000/2);
    }
}

document.addEventListener('keydown', function (event) { //gerenciar as teclas de direita, esquerda e pra baixo e o espaco para pause
	var handled = true;    	
	if (event.keyCode === 37) {       
        	playerMove(-1);
    	} else if (event.keyCode === 39) {
        	playerMove(1);
    	} else if (event.keyCode === 40) {
        	playerDrop();
    	} else if (event.keyCode === 38) {
        	playerRotate(-1);
    	} else if (event.keyCode === 32) {
		if (gamePaused == false) {
			alert("Jogo pausado, pressione espaço novamente para continuar");
			gamePaused = true;
			handled = false;
		} else {
			gamePaused = false;
			handled = true;
			loop();
		}
	}	
	if (handled)
		event.preventDefault();
});


function createTable(width,height){
    var table = document.createElement("table");
    for (let i=0;i<height;i++) {
        var tr = document.createElement("tr");
        for(let o=0;o<width;o++){
            var td = document.createElement("td");
            tr.appendChild(td); 
        }
        table.appendChild(tr);
   }
   div.appendChild(table);
   return table;
}

function playerReset() {
    //const pieces = 'ILJOTSZ+U';
    //player.matrix = createPiece(pieces[pieces.length * Math.random() | 0]);
    pieces = ['I','I','I','I','L','L','L','L','J','J','J','J','O','O','O','O','T','T','T','T','S','S','S','S','Z','Z','Z','Z','P','P','P','P','U','U','U','U'];
    player.matrix = createPiece(pieces.splice(pieces.length * Math.random() | 0)[0]);
    player.pos.y = 0;
    player.pos.x = (arena[0].length / 2 | 0) - (player.matrix[0].length / 2 | 0);
   if (collide(arena, player)) { //finish alert is missing
	alert("Você perdeu");
        arena.forEach(row => row.fill(0));
	$.ajax({
		type: 'POST',
		url: 'index.php?r=jogada%2Fsave',
		data: {
			pontuacao: player.score
		},
	});
        player.score = 0;
        updateScore();
    }
}

function createPiece(type) { //the shapes of the pieces. the number will indicate the color
    if (type === 'T') {
        return [
            [0,0,0],
            [1,1,1],
            [0,1,0],
        ];
    } else if (type === 'O') {
        return [
            [2,2],
            [2,2],
        ]; 
    } else if (type === 'L') {
        return [
            [0,3,0],
            [0,3,0],
            [0,3,3],
        ];
    } else if (type === 'J') {
        return [
            [0,4,0],
            [0,4,0],
            [4,4,0],
        ];
    } else if (type === 'I') {
        return [
            [0,5,0,0],
            [0,5,0,0],
            [0,5,0,0],
            [0,5,0,0],
        ];
    } else if (type === 'S') {
        return [
            [0,6,6],
            [6,6,0],
            [0,0,0],
        ];
    } else if (type === 'Z') {
        return [
            [7,7,0],
            [0,7,7],
            [0,0,0],
        ];
    } else if (type === 'P') {
        return [
            [0,8,0],
            [8,8,8],
            [0,8,0],
        ];
    } else if (type === 'U') {
        return [
            [0,0,0],
            [9,0,9],
            [9,9,9],
        ];
    }
}

function createMatrix(w,h) { //iniciating the matrix with 0's to indicate there's no piece
    const matrix = []; 
    while (h--) {
        matrix.push(new Array(w).fill(0));
    }
    return matrix;
}

function draw () {
    drawMatrix(arena, {x: 0, y: 0});
    drawMatrix(player.matrix, player.pos);  
}

function drawMatrix(matrix,offset){ 
    matrix.forEach((row,y) => {
        row.forEach((type,x) => {
            if (type !== 0) {
                table.rows[y+offset.y].cells[x+offset.x].style.backgroundColor =colors[type];
            } else {
                table.rows[y].cells[x].style.backgroundColor = null;
            }
        });
    });
}

function merge(arena, player) { // merge the arena with the piece
    player.matrix.forEach((row,y) => {
        row.forEach((value,x) => {
            if (value !== 0) {
                arena[y + player.pos.y][x + player.pos.x] = value;
            }
        });
    });
}

function playerDrop() {
    player.pos.y++;
    if (collide(arena, player)) {
        player.pos.y--;
        merge(arena,player);
        playerReset();
        arenaSweep();
        updateScore();
    }
}

function collide (arena, player) { // verifying if the player position reached the top
    const m = player.matrix;
    const o = player.pos;
    for(let y = 0; y < m.length; ++y) {
        for(let x = 0; x < m[y].length; ++x) {
            if(m[y][x] !== 0 &&
              (arena[y + o.y] && 
              arena[y + o.y][x + o.x]) !== 0) {
                  return true;
              }
        }
    }
    return false;
}

function playerMove(offset) {
    player.pos.x += offset;
    if (collide(arena, player)) {
        player.pos.x -= offset;
    }
}

function playerRotate(dir) {
    const pos = player.pos.x;
    let offset = 1;
    rotate(player.matrix, dir);
    while (collide(arena, matrix)) {
        player.pos.x += offset;
        offset = -(offset + (offset > 0 ? 1 : -1));
        if (offset > player.matrix[0].length) {
            rotate(player.matrix, -dir);
            player.pos.x = pos;
            return;
        }
    }
}

function rotate(matrix, dir) {
    for (let y = 0; y < matrix.length; ++y) {
        for (let x = 0; x < y; x++) {
            [
                matrix[x][y],
                matrix[y][x],
            ] = [
                matrix[y][x],
                matrix[x][y], 
            ];
        }
    }

    if (dir > 0) {
        matrix.forEach(row => row.reverse());
    } else {
        matrix.reverse();
    }
}

function arenaSweep() {
    let rowCount = 1;
    outer: for (let y = arena.length - 1; y > 0; --y) {
        for(let x = 0; x < arena[y].length; ++x) {
            if (arena[y][x] === 0) {
                continue outer;
            }
        }

        const row = arena.splice(y,1)[0].fill(0); //removing the pontuating lines
        arena.unshift(row);
        ++y;

        player.score +=  rowCount * 10; //increasing the score
        rowCount *= 2;
    }
}

function updateScore() {
    document.getElementById('score').innerText = player.score;
}

initiateGame();
})();