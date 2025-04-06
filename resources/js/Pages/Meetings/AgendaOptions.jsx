// AgendaOptions.jsx
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

export default function AgendaOptions({ agendaData, setAgendaData }) {
    const handleTitleChange = (e) => {
        setAgendaData(prev => ({...prev, name: e.target.value}));
    };

    const handleDateChange = (name, value) => {
        setAgendaData(prev => ({...prev, [name]: value}));
    };

    const handleQuestionChange = (index, field, value) => {
        const newOptions = [...agendaData.options];
        newOptions[index][field] = value;
        setAgendaData(prev => ({...prev, options: newOptions}));
    };

    const addNewQuestion = () => {
        setAgendaData(prev => ({
            ...prev,
            options: [...prev.options, {
                question: '',
                agreed: [],
                against: [],
                abstained: [],
                attachments: []
            }]
        }));
    };

    const handleDeleteQuestion = (index) => {
        setAgendaData(prev => ({
            ...prev,
            options: prev.options.filter((_, i) => i !== index)
        }));
    };

    return (
        <LocalizationProvider dateAdapter={AdapterDateFns}>
            <Box sx={{ mt: 2 }}>
                {/* Поле ввода названия повестки */}
                <TextField
                    fullWidth
                    label="Название повестки"
                    value={agendaData.name}
                    onChange={handleTitleChange}
                    margin="normal"
                />

                <div className='flex gap-2 justify-between'>
                    {/* Дата начала */}
                    <DateTimePicker
                        label="Дата начала"
                        value={agendaData.start_date}
                        onChange={(value) => handleDateChange('start_date', value)}
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
                        value={agendaData.end_date}
                        onChange={(value) => handleDateChange('end_date', value)}
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
                    {agendaData.options.map((option, index) => (
                        <Box 
                            key={index}
                            sx={{ 
                                display: 'flex', 
                                alignItems: 'center', 
                                gap: 1 
                            }}
                        >
                            <TextField
                                fullWidth
                                label={`Вопрос ${index + 1}`}
                                value={option.question}
                                onChange={(e) => 
                                    handleQuestionChange(index, 'question', e.target.value)
                                }
                            />
                            <IconButton
                                onClick={() => handleDeleteQuestion(index)}
                                color="error"
                            >
                                <Delete />
                            </IconButton>
                        </Box>
                    ))}
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