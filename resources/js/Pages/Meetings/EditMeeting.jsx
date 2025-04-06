import React from 'react';
import { useForm } from '@inertiajs/react';
import {
    Container,
    TextField,
    FormControl,
    InputLabel,
    Select,
    MenuItem,
    Button,
    Box,
    FormHelperText,
    Dialog,
    DialogTitle,
    DialogContent,
    DialogActions,
    IconButton,
  } from '@mui/material';
  import { AddCircleOutline } from '@mui/icons-material';
import { DateTimePicker } from '@mui/x-date-pickers';
import { LocalizationProvider } from '@mui/x-date-pickers/LocalizationProvider';
import { AdapterDateFns } from '@mui/x-date-pickers/AdapterDateFnsV3';
import { useState } from 'react';

export default function EditMeeting({ meeting, meetingTypes }) {
    const [isModalOpen, setIsModalOpen] = useState(false);
  const { data, setData, put, errors, processing } = useForm({
    name: meeting.name || '',
    start_date: new Date(meeting.start_date),
    end_date: new Date(meeting.end_date),
    format_type: meeting.format_type?.value || '',
    chairman_id: meeting.chairman?.id || '',
    secretary_id: meeting.secretary?.id || '',
  });

    // Обработчик открытия модалки
    const handleOpenModal = () => setIsModalOpen(true);
    // Обработчик закрытия модалки
    const handleCloseModal = () => setIsModalOpen(false);

  const handleSubmit = (e) => {
    e.preventDefault();
    put(route('meetings.update', meeting.id));
  };

  return (
    <Container maxWidth="md">
      <Box component="form" onSubmit={handleSubmit} sx={{ mt: 3 }}>
        {/* Название собрания */}
        <TextField
          fullWidth
          label="Название собрания"
          value={data.name}
          onChange={(e) => setData('name', e.target.value)}
          error={!!errors.name}
          helperText={errors.name}
          margin="normal"
        />

        {/* Дата и время начала */}
        <LocalizationProvider dateAdapter={AdapterDateFns}>
          <DateTimePicker
            label="Дата и время начала"
            value={data.start_date}
            onChange={(newValue) => setData('start_date', newValue)}
            renderInput={(params) => (
              <TextField
                {...params}
                fullWidth
                margin="normal"
                error={!!errors.start_date}
                helperText={errors.start_date}
              />
            )}
          />

          {/* Дата и время окончания */}
          <DateTimePicker
            label="Дата и время окончания"
            value={data.end_date}
            onChange={(newValue) => setData('end_date', newValue)}
            renderInput={(params) => (
              <TextField
                {...params}
                fullWidth
                margin="normal"
                error={!!errors.end_date}
                helperText={errors.end_date}
              />
            )}
          />
        </LocalizationProvider>

        {/* Формат проведения */}
        <FormControl fullWidth margin="normal" error={!!errors.format_type}>
          <InputLabel>Формат проведения</InputLabel>
          <Select
            value={data.format_type}
            onChange={(e) => setData('format_type', e.target.value)}
            label="Формат проведения"
          >
            {meetingTypes.map((type) => (
              <MenuItem key={type.value} value={type.value}>
                {type.label}
              </MenuItem>
            ))}
          </Select>
          {errors.format_type && (
            <FormHelperText>{errors.format_type}</FormHelperText>
          )}
        </FormControl>

        {/* Кнопка отправки */}
        <Box sx={{ mt: 3, display: 'flex', justifyContent: 'flex-end' }}>
          <Button
            type="submit"
            variant="contained"
            color="primary"
            disabled={processing}
          >
            Сохранить изменения
          </Button>
        </Box>
      </Box>

      <Box sx={{ 
        position: 'fixed', 
        bottom: 32, 
        right: 32, 
        zIndex: 1000 
      }}>
        <IconButton
          color="primary"
          onClick={handleOpenModal}
          aria-label="Добавить"
          size="large"
        >
          <AddCircleOutline sx={{ fontSize: 48 }} />
        </IconButton>
      </Box>

      {/* Модальное окно */}
      <Dialog
        open={isModalOpen}
        onClose={handleCloseModal}
        maxWidth="sm"
        fullWidth
      >
        <DialogTitle>Новое модальное окно</DialogTitle>
        
        <DialogContent>
          {/* Пока оставляем содержимое пустым */}
          <Box sx={{ height: 200 }} />
        </DialogContent>

        <DialogActions>
          <Button onClick={handleCloseModal}>Закрыть</Button>
        </DialogActions>
      </Dialog>
    </Container>
  );
}