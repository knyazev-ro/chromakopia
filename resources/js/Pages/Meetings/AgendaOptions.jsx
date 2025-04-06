// components/AgendaOptions.jsx
import React from 'react';
import {
  Box,
  TextField,
  IconButton,
  Stack,
} from '@mui/material';
import { AddCircleOutline, Delete } from '@mui/icons-material';

const AgendaOptions = ({ agenda, setAgenda }) => {
  const handleQuestionChange = (index, value) => {
    const newAgenda = [...agenda];
    newAgenda[index] = value;
    setAgenda(newAgenda);
  };

  const addNewQuestion = () => {
    setAgenda([...agenda, '']);
  };

  const handleDeleteQuestion = (index) => {
    if (agenda.length > 1) {
      const newAgenda = agenda.filter((_, i) => i !== index);
      setAgenda(newAgenda);
    }
  };

  return (
    <Box sx={{ mt: 2 }}>
      {/* Поле ввода названия повестки */}
      <TextField
        fullWidth
        label="Название повестки"
        value={agenda[0] || ''}
        onChange={(e) => handleQuestionChange(0, e.target.value)}
        margin="normal"
      />

      {/* Список вопросов */}
      <Stack spacing={2} sx={{ mt: 2 }}>
        {agenda.slice(1).map((question, index) => {
          const questionIndex = index + 1; // Смещаем индекс из-за slice(1)
          return (
            <Box 
              key={questionIndex}
              sx={{ 
                display: 'flex', 
                alignItems: 'center', 
                gap: 1 
              }}
            >
              <TextField
                fullWidth
                label={`Вопрос ${questionIndex}`}
                value={question}
                onChange={(e) => handleQuestionChange(questionIndex, e.target.value)}
              />
              <IconButton
                onClick={() => handleDeleteQuestion(questionIndex)}
                color="error"
                sx={{ 
                  flexShrink: 0,
                  visibility: agenda.length > 1 ? 'visible' : 'hidden' 
                }}
              >
                <Delete />
              </IconButton>
            </Box>
          );
        })}
      </Stack>

      {/* Кнопка добавления нового вопроса */}
      <IconButton
        onClick={addNewQuestion}
        color="primary"
        sx={{ mt: 1 }}
      >
        <AddCircleOutline />
      </IconButton>
    </Box>
  );
};

export default AgendaOptions;