import React from 'react';
import {
  Box,
  TextField,
  IconButton,
  Stack,
} from '@mui/material';
import { AddCircleOutline, Delete } from '@mui/icons-material';
import { DateTimePicker } from '@mui/x-date-pickers/DateTimePicker';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { AdapterDateFns } from '@mui/x-date-pickers/AdapterDateFnsV3';

export default function AgendaOptions({ agenda, setAgenda }){
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
    <LocalizationProvider dateAdapter={AdapterDateFns}>
      <Box sx={{ mt: 2 }}>
        {/* Поле ввода названия повестки */}
        <TextField
          fullWidth
          label="Название повестки"
          value={agenda[0] || ''}
          onChange={(e) => handleQuestionChange(0, e.target.value)}
          margin="normal"
        />

    <div className='flex gap-2 justify-between'>



        {/* Дата начала */}
        <DateTimePicker
          label="Дата начала"
          value={agenda[1] ? new Date(agenda[1]) : null}
          onChange={(newValue) => handleQuestionChange(1, newValue)}
          renderInput={(params) => (
            <TextField
              {...params}
              fullWidth
              margin="normal"
              sx={{ mt: 2 }}
            />
          )}
        />

        {/* Дата окончания */}
        <DateTimePicker
          label="Дата окончания"
          value={agenda[2] ? new Date(agenda[2]) : null}
          onChange={(newValue) => handleQuestionChange(2, newValue)}
          renderInput={(params) => (
            <TextField
              {...params}
              fullWidth
              margin="normal"
              sx={{ mt: 2 }}
            />
          )}
        />
    </div>

        {/* Список вопросов */}
        <Stack spacing={2} sx={{ mt: 2 }}>
          {agenda.slice(3).map((question, index) => {
            const questionIndex = index + 3;
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
                  label={`Вопрос ${questionIndex - 2}`}
                  value={question}
                  onChange={(e) => handleQuestionChange(questionIndex, e.target.value)}
                />
                <IconButton
                  onClick={() => handleDeleteQuestion(questionIndex)}
                  color="error"
                  sx={{ 
                    flexShrink: 0,
                    visibility: agenda.length > 3 ? 'visible' : 'hidden' 
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
    </LocalizationProvider>
  );
};